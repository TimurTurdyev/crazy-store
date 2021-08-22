<?php

namespace App\Services_off\CdekWidget;

class CalculationAction extends BaseAction
{
    /**
     * @return array|string[]
     */
    public function run()
    {
        $shipment = $this->controller->getRequestValue('shipment', array());

        if (empty($shipment['tariffList'])) {
            $shipment['tariffList'] = $this->controller->getSettings()->getTariffPriority($shipment['type']);
        }

        if (($ref = $this->controller->getValue($_SERVER, 'HTTP_REFERER')) && !empty($ref)) {
            $shipment['ref'] = $ref;
        }

        if (empty($shipment['cityToId'])) {
            $cityTo = $this->sendToCity($shipment['cityTo']);
            if ($cityTo && $cityTo['code'] === 200) {
                $pretendents = \json_decode($cityTo['result']);
                if ($pretendents && isset($pretendents->geonames)) {
                    $shipment['cityToId'] = $pretendents->geonames[0]->id;
                }
            }
        }

        if ($shipment['cityToId']) {
            $answer = $this->calculate($shipment);

            if ($answer) {
                $returnData = array(
                    'result' => $answer,
                    'type' => $shipment['type'],
                );
                if ($shipment['timestamp']) {
                    $returnData['timestamp'] = $shipment['timestamp'];
                }

                return $returnData;
            }
        }

        return array('error' => 'City to not found');
    }

    protected function calculate($shipment)
    {
        if (empty($shipment['goods'])) {
            return array('error' => 'The dimensions of the goods are not defined');
        }

        $headers = $this->getHeaders();

        $arData = array(
            'dateExecute' => $this->controller->getValue($headers, 'date'),
            'version' => '1.0',
            'authLogin' => $this->controller->getValue($headers, 'account'),
            'secure' => $this->controller->getValue($headers, 'secure'),
            'senderCityId' => $this->controller->getValue($shipment, 'cityFromId'),
            'receiverCityId' => $this->controller->getValue($shipment, 'cityToId'),
            'ref' => $this->controller->getValue($shipment, 'ref'),
            'widget' => 1,
            'currency' => $this->controller->getValue($shipment, 'currency', 'RUB'),
        );

        if (!empty($shipment['tariffList'])) {
            foreach ($shipment['tariffList'] as $priority => $tariffId) {
                $tariffId = (int)$tariffId;
                $arData['tariffList'] [] = array(
                    'priority' => $priority + 1,
                    'id' => $tariffId
                );
            }
        }

        $arData['goods'] = array();
        foreach ($shipment['goods'] as $arGood) {
            $arData['goods'] [] = array(
                'weight' => $arGood['weight'],
                'length' => $arGood['length'],
                'width' => $arGood['width'],
                'height' => $arGood['height']
            );
        }

        $type = $this->controller->getValue($shipment, 'type');

        $resultTariffs = $this->sendCurlRequest(
            'http://api.cdek.ru/calculator/calculate_tarifflist.php',
            \json_encode($arData),
            true
        );
        if ($resultTariffs && $resultTariffs['code'] === 200) {
            if (!\is_null(\json_decode($resultTariffs['result'], false))) {
                $resultTariffs = \json_decode($resultTariffs['result'], true);

                $returnFirst = function ($array) {
                    $first = reset($array);

                    return $first['result'];
                };

                if (!empty($type) && empty($arData['tariffId'])) {
                    $tariffListSorted = $this->controller->getSettings()->getTariffPriority($type);

                    $array_column = function ($array, $columnName) {
                        return \array_map(function ($element) use ($columnName) {
                            return $element[$columnName];
                        }, $array);
                    };

                    $calcTariffs = \array_filter(
                        $this->controller->getValue($resultTariffs, 'result', array()),
                        function ($item) {
                            return $item['status'] === true;
                        }
                    ) ?: array();

                    $calcTariffs = \array_combine($array_column($calcTariffs, 'tariffId'), $calcTariffs);

                    foreach ($tariffListSorted as $tariffId) {
                        if (\array_key_exists($tariffId, $calcTariffs)) {
                            return $calcTariffs[$tariffId]['result'];
                        }
                    }
                    return $returnFirst($calcTariffs);
                }
                return $returnFirst($resultTariffs);
            }
            return array('error' => 'Wrong server answer');
        }

        return array('error' => 'Wrong answer code from server : ' . $resultTariffs['code']);
    }

    protected function sendToCity($city)
    {
        static $action;
        if (!$action) {
            $action = new AddressAction($this->controller);
        }

        return $action->run(array('city' => $city));
    }


    protected function getHeaders()
    {
        $date = date('Y-m-d');
        $headers = array(
            'date' => $date
        );

        $settings = $this->controller->getSettings();
        if ($settings->hasCredentials()) {
            $headers = array(
                'date' => $date,
                'account' => $settings->getAccount(),
                'secure' => md5($date . "&" . $settings->getKey())
            );
        }

        return $headers;
    }
}
