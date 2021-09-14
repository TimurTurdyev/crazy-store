<?php

namespace App\Main\Tinkoff\Api;

use App\Main\Tinkoff\Adapters\OrderTinkoffAdapter;
use App\Models\Order;

class Init extends TinkoffAbstract
{
    protected string $entity = 'Init';

    protected array $adapters = [
        Order::class => OrderTinkoffAdapter::class
    ];

    /**
     * @throws \Exception
     */
    public function __construct(object $entity)
    {
        if (!isset($this->adapters[$entity::class])) {
            throw new \Exception('Adapter not found', 400);
        }

        parent::__construct(new $this->adapters[$entity::class]($entity));
    }

    public function apply(): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return $this->send();
    }
}
