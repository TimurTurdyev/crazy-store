<?php

namespace App\Main\Tinkoff;

class TinkoffClient
{
    private $test = false;

    public function setTest(bool $value): static
    {
        $this->test = $value;
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function init(object $entity): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        $init = new Api\Init($entity);

        if ($this->test) {
            return $init->test()->apply();
        }

        return $init->apply();
    }
}
