<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Main\Cdek\Client as CdekClient;
use App\Main\Cdek\Oauth;
use App\Main\Pochta\Client as PochtaClient;
use App\Repositories\CartInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(CartInterface $cart): \Illuminate\Contracts\View\View
    {
        return view('catalog.order.index', compact('cart'));
    }

    public function deliveries($postal_code, Request $request)
    {
        $client = new CdekClient((new Oauth())->authorize());

        $mode = [
            3 => ['name' => '', 'code' => '', 'sum' => 0,],
            4 => ['name' => '', 'code' => '', 'sum' => 0,]
        ];

        $cdek = $client->tariffs([
            'type' => 1,
            'currency' => 1,
            'lang' => 'rus',
            'from_location' => ['postal_code' => config('cdek.postal_code')],
            'to_location' => ['postal_code' => $postal_code],
            'packages' => [
                ['height' => 10, 'length' => 10, 'weight' => 500, 'width' => 10]
            ]
        ])
            ->collect('tariff_codes')
            ->whereIn('delivery_mode', array_keys($mode))
            ->map(function ($item) use (&$mode) {
                $value = $mode[$item['delivery_mode']];

                if ($value['sum'] === 0 || $value['sum'] > $item['delivery_sum']) {
                    $mode[$item['delivery_mode']] = [
                        'code' => $item['tariff_code'],
                        'sum' => $item['delivery_sum']
                    ];
                }

                return [
                    'group' => 'Курьерская служба CDEK',
                    'code' => $item['tariff_code'],
                    'name' => $item['delivery_mode'] === 4 ? 'CDEK - Пункт выдачи' : 'CDEk - Курьер',
                    'name_hidden' => $item['tariff_name'],
                    'type' => $item['delivery_mode'] === 4 ? 'cdek.pvz' : 'cdek.courier',
                    'price' => $item['delivery_sum'],
                    'mode' => $item['delivery_mode'],
                ];
            })
            ->filter(function ($item, $key) use ($mode) {
                return $item['code'] === $mode[$item['mode']]['code'];
            });

        $pochtaStandart = (new PochtaClient())->tariffStandart(['from' => config('cdek.postal_code'), 'to' => $postal_code])->json();
        $pochta1Class = (new PochtaClient())->tariff1Class(['from' => config('cdek.postal_code'), 'to' => $postal_code])->json();

        $min_value = 0;
        $pochta = collect([$pochtaStandart, $pochta1Class])->filter(function ($item) {
            return $item['paynds'] ?? false;
        })->map(function ($item) use (&$min_value) {
            $value = $item['paynds'] / 100;
            $min_value = min($value, $min_value ?: $value);

            return [
                'group' => 'Почта России',
                'code' => $item['id'],
                'name' => 'Почтовое отправление',
                'name_hidden' => $item['name'],
                'type' => 'pochta',
                'price' => $value,
            ];
        })->filter(function ($item) use ($min_value) {
            return $item['price'] <= $min_value;
        });

        return view('widget.deliveries', ['deliveries' => $cdek->merge($pochta)]);
    }
}
