<?php

namespace App\Services\CdekWidget;

class PickupAction extends BaseAction
{
    /**
     * @return array|string[]
     */
    public function run()
    {
        if (!\function_exists('simplexml_load_string')) {
            return array('error' => 'No php simplexml-library installed on server');
        }

        $langPart = $this->controller->getRequestValue('lang') ? '&lang=' . $this->controller->getRequestValue('lang') : '';
        $request = $this->sendCurlRequest('https://integration.cdek.ru/pvzlist/v1/xml?type=ALL' . $langPart);

        if ($request && $request['code'] === 200) {
            $xml = \simplexml_load_string($request['result']);

            $arList = array('PVZ' => array(), 'CITY' => array(), 'REGIONS' => array(), 'CITYFULL' => array(), 'COUNTRIES' => array());

            foreach ($xml as $key => $val) {

                if (($country = $this->controller->getRequestValue('country'))
                    && $country !== 'all'
                    && ((string)$val['CountryName'] !== $country)) {
                    continue;
                }

                $cityCode = (string)$val['CityCode'];
                $type = 'PVZ';
                $city = (string)$val['City'];
                if (strpos($city, '(') !== false) {
                    $city = \trim(\mb_substr($city, 0, \strpos($city, '(')));
                }
                if (strpos($city, ',') !== false) {
                    $city = \trim(\mb_substr($city, 0, \strpos($city, ',')));
                }
                $code = (string)$val['Code'];

                $arList[$type][$cityCode][$code] = array(
                    'Name' => (string)$val['Name'],
                    'WorkTime' => (string)$val['WorkTime'],
                    'Address' => (string)$val['Address'],
                    'Phone' => (string)$val['Phone'],
                    'Note' => (string)$val['Note'],
                    'cX' => (string)$val['coordX'],
                    'cY' => (string)$val['coordY'],
                    'Dressing' => ((string)$val['IsDressingRoom'] === 'true'),
                    'Cash' => ((string)$val['HaveCashless'] === 'true'),
                    'Postamat' => (\strtolower($val['Type']) === 'postamat'),
                    'Station' => (string)$val['NearestStation'],
                    'Site' => (string)$val['Site'],
                    'Metro' => (string)$val['MetroStation'],
                    'AddressComment' => (string)$val['AddressComment'],
                    'CityCode' => (string)$val['CityCode'],
                );
                if ($val->WeightLimit) {
                    $arList[$type][$cityCode][$code]['WeightLim'] = array(
                        'MIN' => (float)$val->WeightLimit['WeightMin'],
                        'MAX' => (float)$val->WeightLimit['WeightMax']
                    );
                }

                $arImgs = array();

                foreach ($val->OfficeImage as $img) {
                    if (strpos($_tmpUrl = (string)$img['url'], 'http') === false) {
                        continue;
                    }
                    $arImgs[] = (string)$img['url'];
                }

                if (\count($arImgs = \array_filter($arImgs))) {
                    $arList[$type][$cityCode][$code]['Picture'] = $arImgs;
                }
                if ($val->OfficeHowGo) {
                    $arList[$type][$cityCode][$code]['Path'] = (string)$val->OfficeHowGo['url'];
                }

                if (!\array_key_exists($cityCode, $arList['CITY'])) {
                    $arList['CITY'][$cityCode] = $city;
                    $arList['CITYREG'][$cityCode] = (int)$val['RegionCode'];
                    $arList['REGIONSMAP'][(int)$val['RegionCode']][] = (int)$cityCode;
                    $arList['CITYFULL'][$cityCode] = $val['CountryName'] . ' ' . $val['RegionName'] . ' ' . $city;
                    $arList['REGIONS'][$cityCode] = \implode(', ', \array_filter(array((string)$val['RegionName'], (string)$val['CountryName'])));
                }

            }

            \krsort($arList['PVZ']);

            return array('pvz' => $arList);
        }

        if ($request) {

            return array('error' => 'Wrong answer code from server : ' . $request['code']);
        }
        return array('error' => 'Some error PVZ');
    }
}
