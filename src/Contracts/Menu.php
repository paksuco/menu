<?php

namespace Paksuco\Menu\Contracts;
use Paksuco\Menu\MenuManager;
use Paksuco\Menu\MenuContainer;

abstract class Menu {

    protected $manager;

    protected $key;

    public function __construct(MenuManager $manager)
    {
        $this->key = $this->key ?? "";
        $this->manager = $manager;
        $this->register($this->manager->menu($this->key));
    }

    abstract function register(MenuContainer $container);

    public function getKey()
    {
        return $this->key;
    }
}
