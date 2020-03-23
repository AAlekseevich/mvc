<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 16.03.2020
 * Time: 21:24
 */

namespace Base;

use Throwable;

class RedirectException extends Exception
{
    private $_location;

    public function __construct(string $message, int $code, Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
        $this->_location = $message;
    }

    public function getLocation()
    {
        return $this->_location;
    }
}