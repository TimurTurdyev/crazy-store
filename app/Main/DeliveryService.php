<?php

namespace App\Main;

use App\Main\Cdek\Oauth;
use App\Main\Cdek\Client as CdekClient;
use App\Main\Pochta\Client as PochtaClient;
use Illuminate\Support\Collection;

class DeliveryService
{
    private string $postal_code;

    private Collection $deliveries;

    public function __construct(string $postal_code)
    {
        $this->postal_code = $postal_code;
        $this->deliveries = new Collection();
    }

    public function cdek(): static
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
            'to_location' => ['postal_code' => $this->postal_code],
            'packages' => [
                ['height' => 20, 'length' => 20, 'weight' => 500, 'width' => 20]
            ]
        ])
            ->collect('tariff_codes')
            ->whereIn('delivery_mode', array_keys($mode))
            ->map(function ($item) use (&$mode) {
                if ($item['delivery_mode'] === 4) {
                    $code = sprintf('cdek.pvz.%d', $item['tariff_code']);
                    $name = 'CDEK - Пункт выдачи';
                } else {
                    $code = sprintf('cdek.courier.%s', $item['tariff_code']);
                    $name = 'CDEK - Курьер';
                }

                $value = $mode[$item['delivery_mode']];

                if ($value['sum'] === 0 || $value['sum'] > $item['delivery_sum']) {
                    $mode[$item['delivery_mode']] = [
                        'code' => $code,
                        'sum' => $item['delivery_sum']
                    ];
                }

                return [
                    'group' => 'Курьерская служба CDEK',
                    'code' => $code,
                    'name' => $name,
                    'price' => $item['delivery_sum'],
                    'mode' => $item['delivery_mode'],
                ];
            })
            ->filter(function ($item, $key) use ($mode) {
                return $item['code'] === $mode[$item['mode']]['code'];
            });

        if ($cdek->count()) {
            $this->deliveries->push(...$cdek->toArray());
        }

        return $this;
    }

    public function cdekExtended(): static
    {
        $client = new CdekClient((new Oauth())->authorize());

        $cdek = $client->tariffs([
            'type' => 1,
            'currency' => 1,
            'lang' => 'rus',
            'from_location' => ['postal_code' => config('cdek.postal_code')],
            'to_location' => ['postal_code' => $this->postal_code],
            'packages' => [
                ['height' => 20, 'length' => 20, 'weight' => 500, 'width' => 20]
            ]
        ])
            ->collect('tariff_codes')
            ->whereIn('delivery_mode', [3, 4])
            ->map(function ($item) {
                if ($item['delivery_mode'] === 4) {
                    $code = sprintf('cdek.pvz.%d', $item['tariff_code']);
                    $name = 'CDEK - Пункт выдачи';
                } else {
                    $code = sprintf('cdek.courier.%s', $item['tariff_code']);
                    $name = 'CDEK - Курьер';
                }

                return [
                    'group' => 'Курьерская служба CDEK',
                    'code' => $code,
                    'name' => sprintf('%s - %s', $item['tariff_name'], sprintf('От %s до %s дней', $item['period_min'], $item['period_max'])),
                    'price' => $item['delivery_sum'],
                ];
            })->sortBy('price');

        if ($cdek->count()) {
            $this->deliveries->push(...$cdek->toArray());
        }

        return $this;
    }

    public function pochta(): static
    {
        $pochtaStandart = (new PochtaClient())->tariffStandart(['from' => config('cdek.postal_code'), 'to' => $this->postal_code])->json();
        $pochta1Class = (new PochtaClient())->tariff1Class(['from' => config('cdek.postal_code'), 'to' => $this->postal_code])->json();

        $min_value = 0;
        $pochta = collect([$pochtaStandart, $pochta1Class])->filter(function ($item) {
            return $item['paynds'] ?? false;
        })->map(function ($item) use (&$min_value) {
            $value = $item['paynds'] / 100;
            $min_value = min($value, $min_value ?: $value);

            return [
                'group' => 'Почта России',
                'code' => sprintf('pochta.%d', $item['id']),
                'name' => 'Почтовое отправление',
                'price' => $value,
            ];
        })->filter(function ($item) use ($min_value) {
            return $item['price'] <= $min_value;
        });

        if ($pochta->count()) {
            $this->deliveries->push(...$pochta->toArray());
        }

        return $this;
    }

    public function pochtaExtended(): static
    {
        $pochtaStandart = (new PochtaClient())->tariffStandart(['from' => config('cdek.postal_code'), 'to' => $this->postal_code])->json();
        $pochta1Class = (new PochtaClient())->tariff1Class(['from' => config('cdek.postal_code'), 'to' => $this->postal_code])->json();

        $pochta = collect([$pochtaStandart, $pochta1Class])->filter(function ($item) {
            return $item['paynds'] ?? false;
        })->map(function ($item) {
            $value = $item['paynds'] / 100;

            return [
                'group' => 'Почта России',
                'code' => sprintf('pochta.%d', $item['id']),
                'name' => $item['name'],
                'price' => $value,
            ];
        })->sortBy('price');

        if ($pochta->count()) {
            $this->deliveries->push(...$pochta->toArray());
        }

        return $this;
    }

    public function getDeliveries(): Collection
    {
        return $this->deliveries;
    }
}
