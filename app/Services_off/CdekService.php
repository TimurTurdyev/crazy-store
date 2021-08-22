<?php

namespace App\Services_off;

use GuzzleHttp\Client;
use CdekSDK2\Client as CdekClient;

class CdekService implements CdekInterface
{

    private CdekClient $cdek;

    public function __construct()
    {
        $this->cdek = new CdekClient(new Client(), 'ywlpBpmoczbBquYnskgSNx0fIlXX4obs', 'CvPyAQxQHAWW0C816CT4n0N6nyfWWrh8');
        $this->cdek->setTest(true);
    }

    public function offices() {
        $result = $this->cdek->offices()->getFiltered(['country_code' => 'ru', 'city' => 'Москва']);
        if ($result->isOk()) {
            //Запрос успешно выполнился
            $pvzlist = $this->cdek->formatResponseList($result, \CdekSDK2\Dto\PickupPointList::class);
            foreach($pvzlist->items as $pvz) {
                dd($pvz);
                $pvz->code;
                $pvz->location->address;
            }
        }
    }
}
