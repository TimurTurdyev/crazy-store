<?php

namespace App\Services_off\CdekWidget;

class Controller
{
    /**
     * @var array $request
     */
    private $request;
    /**
     * @var array $response
     */
    private $response;
    /**
     * @var Settings $settings
     */
    private $settings;

    /**
     * Entrypoint
     * @param Settings $settings
     */
    public static function processRequest(Settings $settings, $request)
    {
        $self = new self($settings, $request);
        $self->toResponse(
            $self->getAction()
                ->run()
        );
        return $self->response;
    }

    /**
     * @param array|mixed $data
     * @return void
     */
    public function toResponse($data)
    {
        if (!is_array($data)) {
            $data = array('info' => $data);
        }

        foreach ($data as $key => $value) {
            if ($key === 'error') {
                if (!array_key_exists($key, $this->response)) {
                    $this->response[$key] = array();
                }
                $this->response[$key][] = $value;
            } else {
                $this->response[$key] = $value;
            }
        }
    }

    /**
     * @param array $fromArray
     * @param string|int $key
     * @param mixed|null $default
     * @return mixed|null
     */
    public function getValue($fromArray, $key, $default = null)
    {
        return isset($fromArray[$key]) ? $fromArray[$key] : $default;
    }

    /**
     * @param string|int $key
     * @param mixed|null $default
     * @return mixed|null
     */
    public function getRequestValue($key, $default = null)
    {
        return $this->getValue($this->request, $key, $default);
    }

    /**
     * @return Settings
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @return BaseAction concrete action implementation
     */
    protected function getAction()
    {
        $actionName = $this->getRequestValue('isdek_action');
        switch (true) {
            case $actionName === 'getPVZ':
                $action = new PickupAction($this);
                break;
            case $actionName === 'getCity':
                $action = new AddressAction($this);
                break;
            case $actionName === 'calc':
                $action = new CalculationAction($this);
                break;
            case $actionName === 'getLang':
                $action = new I18nAction($this);
                break;
            default:
                $action = new UnknownAction($this);
        }
        return $action;
    }

    /**
     * Controller constructor.
     * @param Settings $settings
     */
    protected function __construct(Settings $settings, $request)
    {
        $this->request = $request;
        $this->response = array();
        $this->settings = $settings;
    }
}
