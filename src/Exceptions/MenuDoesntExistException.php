<?php

namespace Paksuco\Menu\Exceptions;

use Exception;

class MenuDoesntExistException extends Exception
{
    protected $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function __toString()
    {
        return "Menu with key '".$this->key."' doesn't exist. You should first create a menu class with that key.";
    }
}
