<?php

namespace App\Services_off\CdekWidget;


class AddressAction extends BaseAction
{
    /**
     * @param array $data (optional)
     * @return array|string[]
     */
    public function run($data = array())
    {
        if ($city = $this->controller->getRequestValue(
            'city',
            $this->controller->getValue($data, 'city')
        )
        ) {
            return $this->getCityByName($city);
        }

        if ($address = $this->controller->getRequestValue(
            'address',
            $this->controller->getValue($data, 'address')
        )
        ) {
            return $this->getCityByAddress($address);
        }

        return array('error' => 'No city to search given');
    }

    /**
     * @param string $name
     * @param bool $single
     * @return array|string[]
     */
    protected function getCityByName($name, $single = true)
    {
        $arReturn = array();

        $result = $this->sendCurlRequest(
            'http://api.cdek.ru/city/getListByTerm/json.php?q=' . \urlencode($name)
        );
        if ($result && $result['code'] == 200) {
            $result = json_decode($result['result']);
            if (!isset($result->geonames)) {
                $arReturn = array('error' => 'No cities found');
            } else {
                if ($single) {
                    $arReturn = array(
                        'id' => $result->geonames[0]->id,
                        'city' => $result->geonames[0]->cityName,
                        'region' => $result->geonames[0]->regionName,
                        'country' => $result->geonames[0]->countryName
                    );
                } else {
                    $arReturn['cities'] = array();
                    foreach ($result->geonames as $city) {
                        $arReturn['cities'][] = array(
                            'id' => $city->id,
                            'city' => $city->cityName,
                            'region' => $city->regionName,
                            'country' => $city->countryName
                        );
                    }
                }
            }
        } else {
            $arReturn = array('error' => 'Wrong answer code from server : ' . $result['code']);
        }

        return $arReturn;
    }

    public function getCityByAddress($address)
    {
        $arReturn = array();
        $arStages = array('country' => false, 'region' => false, 'subregion' => false);
        $arAddress = \explode(',', $address);

        $ind = 0;
        // finging country in address
        if (\in_array((string)$arAddress[0], $this->getCountries(), true)) {
            $arStages['country'] = \mb_strtolower(\trim($arAddress[0]));
            $ind++;
        }
        // finding region in address
        foreach ($this->getRegion() as $regionStr) {
            $search = \mb_strtolower(\trim($arAddress[$ind]));
            $indSearch = \strpos($search, $regionStr);
            if ($indSearch !== false) {
                if ($indSearch) {
                    $arStages['region'] = \mb_substr($search, 0, \strpos($search, $regionStr));
                } else {
                    $arStages['region'] = \mb_substr($search, \mb_strlen($regionStr));
                }
                $arStages['region'] = \trim($arStages['region']);
                $ind++;
                break;
            }
        }
        // finding subregions
        foreach ($this->getSubRegion() as $subRegionStr) {
            $search = \mb_strtolower(\trim($arAddress[$ind]));
            $indSearch = \strpos($search, $subRegionStr);
            if ($indSearch !== false) {
                if ($indSearch) {
                    $arStages['subregion'] = \mb_substr($search, 0, \strpos($search, $subRegionStr));
                } else {
                    $arStages['subregion'] = \mb_substr($search, \mb_strlen($subRegionStr));
                }
                $arStages['subregion'] = \trim($arStages['subregion']);
                $ind++;
                break;
            }
        }
        // finding city
        $cityName = trim($arAddress[$ind]);
        $cdekCity = $this->getCityByName($cityName, false);

        if (!empty($cdekCity['error'])) {
            foreach ($this->getCityDef() as $placeLbl) {
                $search = \str_replace('ё', 'е', \mb_strtolower(\trim($arAddress[$ind])));
                $indSearch = \strpos($search, $placeLbl);
                if ($indSearch !== false) {
                    if ($indSearch) {
                        $search = \mb_substr($search, 0, \strpos($search, $placeLbl));
                    } else {
                        $search = \mb_substr($search, \mb_strlen($placeLbl));
                    }
                    $search = \trim($search);
                    $cityName = $search;
                    $cdekCity = $this->getCityByName($search, false);
                    break;
                }
            }
        }

        if (!empty($cdekCity['error'])) {
            $arReturn['error'] = $cdekCity['error'];
        } else {
            if (\count($cdekCity['cities']) > 0) {
                $pretend = false;
                $arPretend = array();
                // parseCountry
                if ($arStages['country']) {
                    foreach ($cdekCity['cities'] as $arCity) {
                        $possCountry = \mb_strtolower($arCity['country']);
                        if (!$possCountry || \mb_stripos($arStages['country'], $possCountry) !== false) {
                            $arPretend [] = $arCity;
                        }
                    }
                } else {
                    $arPretend = $cdekCity['cities'];
                }

                // parseRegion
                if (!empty($arStages['region']) && (\count($arPretend) > 1)) {
                    $_arPretend = array();
                    foreach ($arPretend as $arCity) {
                        $possRegion = \str_replace($this->getRegion(), '', \mb_strtolower(\trim($arCity['region'])));
                        if (!$possRegion || \mb_stripos($possRegion, \str_replace($this->getRegion(), '', $arStages['region'])) !== false) {
                            $_arPretend [] = $arCity;
                        }
                    }
                    $arPretend = $_arPretend;
                }

                // parseSubRegion
                if (!empty($arStages['subregion']) && (\count($arPretend) > 1)) {
                    $_arPretend = array();
                    foreach ($arPretend as $arCity) {
                        $possSubRegion = \mb_strtolower($arCity['city']);
                        if (!$possSubRegion || \mb_stripos($possSubRegion, $arStages['subregion']) !== false) {
                            $_arPretend [] = $arCity;
                        }
                    }
                    $arPretend = $_arPretend;
                }
                // parseUndefined
                // not full city name
                if (\count($arPretend) > 1) {
                    $_arPretend = array();
                    foreach ($arPretend as $arCity) {
                        if (\mb_stripos($arCity['city'], ',') === false) {
                            $_arPretend [] = $arCity;
                        }
                    }
                    $arPretend = $_arPretend;
                }
                if (\count($arPretend) > 1) {
                    $_arPretend = array();
                    foreach ($arPretend as $arCity) {
                        if (\mb_strlen($arCity['city']) === \mb_strlen($cityName)) {
                            $_arPretend [] = $arCity;
                        }
                    }
                    $arPretend = $_arPretend;
                }
                // federalCities
                if (\count($arPretend) > 1) {
                    $_arPretend = array();
                    foreach ($arPretend as $arCity) {
                        if ($arCity['city'] === $arCity['region']) {
                            $_arPretend [] = $arCity;
                        }
                    }
                    $arPretend = $_arPretend;
                }


                // end
                if (\count($arPretend) === 1) {
                    $pretend = \array_pop($arPretend);
                }
            } else {
                $pretend = $cdekCity['cities'][0];
            }
            if ($pretend) {
                $arReturn['city'] = $pretend;
            } else {
                $arReturn['error'] = 'Undefined city';
            }
        }
        return $arReturn;
    }

    protected function getCountries()
    {
        return array('Россия');
    }

    protected function getRegion()
    {
        return array('автономная область', 'область', 'республика', 'автономный округ', 'округ', 'край', 'обл.');
    }

    protected function getSubRegion()
    {
        return array('муниципальный район', 'район', 'городской округ');
    }

    protected function getCityDef()
    {
        return array(
            'поселок городского типа',
            'населенный пункт',
            'курортный поселок',
            'дачный поселок',
            'рабочий поселок',
            'почтовое отделение',
            'сельское поселение',
            'ж/д станция',
            'станция',
            'городок',
            'деревня',
            'микрорайон',
            'станица',
            'хутор',
            'аул',
            'поселок',
            'село',
            'снт'
        );
    }
}
