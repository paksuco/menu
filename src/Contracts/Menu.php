<?php

namespace Paksuco\Menu\Contracts;

use Paksuco\Menu\Exceptions\InvalidKeyException;
use Paksuco\Menu\MenuContainer;
use Paksuco\Menu\MenuManager;

/**
 * Abstract class for creating renderable menu objects
 */
abstract class Menu
{
    /**
     * Dependency injected MenuManager instance
     *
     * @var MenuManager
     */
    protected $manager;

    /**
     * The key of the menu
     *
     * @var string
     */
    protected $key = "";

    /**
     * Menu instance created by the MenuManager singleton
     *
     * @var MenuContainer
     */
    protected $menu;

    /**
     * Class constructor
     *
     * @param   MenuManager  $manager  The global menu manager
     *
     * @return  void
     */
    public function __construct(MenuManager $manager)
    {
        if (empty($this->key)) {
            throw new InvalidKeyException();
        }
        $this->manager = $manager;
        $this->manager->push($this);
        $this->menu = new MenuContainer();
        $this->build($this->menu);
    }

    /**
     * Gets the current menu key, used for matching Menu definition with Menu Component
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Gets the current menu container, used for building the items
     */
    public function getContainer()
    {
        return $this->menu;
    }

    /**
     * Registers the menu items to the container
     *
     * @param   MenuContainer  $container  The menu container which will hold the items
     *
     * @return  void
     */
    abstract public function build(MenuContainer $container);

}
