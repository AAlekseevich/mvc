<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 14.03.2020
 * Time: 16:46
 */

namespace Base;


class Request
{
    private $requestModule;
    private $requestController;
    private $requestParams;
    private $requestUri;

    public function __construct()
    {
        $this->requestParams = $_REQUEST;
        $this->requestUri = $_SERVER['REQUEST_URI'];
    }


    public function handle()
    {
        $parts = explode( '/', $this->requestUri);
        if(!$parts || sizeof($parts) < 1) {
            $this->requestModule = false;
            $this->requestController = false;
            $this->requestParams = false;
        } else {
            foreach ($parts as $k => $part) {
                if ($part && !$this->validate($part)) {
                    throw new \Exception('Url part #' . $k . ' not valid: ' . $part);
                }
            }

            $this->requestModule = !empty($parts[1]) ? $parts[1] : false;
            $this->requestController = !empty($parts[2]) ? $parts[2] : false;
            $this->requestParams = !empty($parts[3]) ? $parts[3] : false;
        }
    }

    private function validate($urlPart)
    {
        $ret = preg_match('/^[a-zA-Z0-9]+$/', $urlPart);
        return $ret;
    }

    /**
     * @return mixed
     */
    public function getRequestModule()
    {
        return $this->requestModule;
    }

    /**
     * @return mixed
     */
    public function getRequestController()
    {
        return $this->requestController;
    }

    /**
     * @return mixed
     */
    public function getRequestParams()
    {
        return $this->requestParams;
    }

    /**
     * @return mixed
     */
    public function getRequestUri()
    {
        return $this->requestUri;
    }

    public function getIp()
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    public function getUserAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }
}