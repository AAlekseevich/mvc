<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 14.03.2020
 * Time: 19:26
 */

namespace App\Main\Controller;


use Base\ControllerAbstract;

class Main extends ControllerAbstract
{
    public function mainAction()
    {
        $this->tpl = 'main.phtml';
    }
}