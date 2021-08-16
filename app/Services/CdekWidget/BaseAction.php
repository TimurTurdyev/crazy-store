<?php

namespace App\Services\CdekWidget;

abstract class BaseAction
{
    /**
     * @var Controller $controller
     */
    protected $controller;

    /**
     * BaseAction constructor.
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return array|mixed result data for response
     */
    abstract public function run();

    /**
     * @param string $url
     * @param array|string|bool $data
     * @param bool $rawRequest
     * @return array
     */
    protected function sendCurlRequest($url, $data = false, $rawRequest = false)
    {
        if (!\function_exists('curl_init')) {
            return array('error' => 'No php CURL-library installed on server');
        }

        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => TRUE
        );

        if ($rawRequest) {
            $curlOptions[CURLOPT_POST] = FALSE;
            $curlOptions[CURLOPT_HTTPHEADER] = array('Content-type: application/json');
        }

        if ($data) {
            $curlOptions += array(
                CURLOPT_POST => TRUE,
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_REFERER => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'],
            );
        }

        $ch = \curl_init();
        \curl_setopt_array($ch, $curlOptions);
        $result = \curl_exec($ch);
        $code = \curl_getinfo($ch, CURLINFO_HTTP_CODE);
        \curl_close($ch);

        return array(
            'code' => $code,
            'result' => $result
        );
    }
}
