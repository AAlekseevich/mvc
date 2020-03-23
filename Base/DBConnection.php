<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 15.03.2020
 * Time: 20:33
 */

namespace Base;

use Illuminate\Database\Capsule\Manager as Capsule;

class DBConnection
{


    public function __construct()
    {
        $capsule = new Capsule();

        $capsule->addConnection([
            'driver' => DB_DRIVER,
            'host' => DB_HOST,
            'database' => DB_NAME,
            'username' => DB_USER,
            'password' => DB_PASS,
            'charset' => DB_CHAR,
            'collation' => DB_COLLATION,
            'prefix' => DB_PREFIX,
        ]);

        $capsule->bootEloquent();
    }
}