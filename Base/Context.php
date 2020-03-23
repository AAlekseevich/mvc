<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 14.03.2020
 * Time: 17:02
 */

namespace Base;


class Context
{
    private $request;
    private $routers;
    private $user;
    private $dbConnection;
    private static $instance;

    private function __construct()
    {
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function getRouters()
    {
        return $this->routers;
    }

    /**
     * @param mixed $routers
     */
    public function setRouters($routers)
    {
        $this->routers = $routers;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getDbConnection()
    {
        return $this->dbConnection;
    }

    /**
     * @param mixed $dbConnection
     */
    public function setDbConnection($dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }



}