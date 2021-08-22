<?php

namespace App\Services_off\CdekWidget;

class Settings
{
    const COURIER_TARIFF_PRIORITY = 'courier';

    const PICKUP_TARIFF_PRIORITY = 'pickup';

    /**
     * @var array $courierTariffPriority
     */
    private $courierTariffPriority;
    /**
     * @var array $pickupTariffPriority
     */
    private $pickupTariffPriority;
    /**
     * @var string|bool $account
     */
    private $account;
    /**
     * @var string|bool $key
     */
    private $key;

    /**
     * @param array $courierTariffPriority
     * @param array $pickupTariffPriority
     * @param string|bool $account
     * @param string|bool $key
     */
    private function __construct($courierTariffPriority, $pickupTariffPriority, $account, $key)
    {
        $this->courierTariffPriority = $courierTariffPriority;
        $this->pickupTariffPriority = $pickupTariffPriority;
        $this->account = $account ?: false;
        $this->key = $key ?: false;
    }

    /**
     * @param array $courierTariffPriority
     * @param array $pickupTariffPriority
     * @param string|bool $account
     * @param string|bool $key
     * @return \SDEKService\Settings
     */
    public static function factory($courierTariffPriority, $pickupTariffPriority, $account, $key)
    {
        return new self($courierTariffPriority, $pickupTariffPriority, $account, $key);
    }

    /**
     * @param string|null $type
     * @return array - all or concrete tariffs priority
     * @throws \InvalidArgumentException
     */
    public function getTariffPriority($type = self::COURIER_TARIFF_PRIORITY)
    {
        if (!\in_array($type, array(self::COURIER_TARIFF_PRIORITY, self::PICKUP_TARIFF_PRIORITY), true)) {
            throw new \InvalidArgumentException("Unknown tariff type {$type}");
        }

        return $type === self::COURIER_TARIFF_PRIORITY ? $this->courierTariffPriority : $this->pickupTariffPriority;
    }

    /**
     * @return bool
     */
    public function hasCredentials()
    {
        return $this->account && $this->key;
    }

    /**
     * @return bool|string
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @return bool|string
     */
    public function getKey()
    {
        return $this->key;
    }
}
