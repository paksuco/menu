<?php

namespace Paksuco\Menu;

use Illuminate\Support\Facades\Event;
use Paksuco\Menu\Contracts\Menu;
use Paksuco\Menu\Exceptions\MenuDoesntExistException;

class MenuManager
{
    /**
     * Collection of user-generated menus
     *
     * @var \Illuminate\Support\Collection
     */
    protected $menus = null;

    /**
     * Singleton instance holder
     *
     * @var MenuManager
     */
    protected static $instance = null;

    /**
     * Class constructor
     */
    private function __construct()
    {
        // create the menu holder
        $this->menus = collect();
    }

    /**
     * Singleton instance retriever
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new static;
        }

        return self::$instance;
    }

    public function menu($key)
    {
        if ($this->menus->has($key)) {
            return $this->menus->get($key)->getContainer();
        }
        throw new MenuDoesntExistException($key);
    }

    public function push(Menu $menu)
    {
        $key = $menu->getKey();
        $this->menus[$key] = $menu;
    }

    public function dump(string $key, string $theme)
    {
        if ($this->menus->has($key)) {
            // Enable other classes to extend the menu items
            Event::dispatch("paksuco.menu.beforeRender", [
                "key" => $key,
                "container" => $this->menus->get($key)->getContainer(),
            ]);

            $container = $this->menus->get($key)->getContainer();

            $container->setTheme($theme);

            return view("paksuco::menucontainer", [
                "container" => $container,
                "level" => 0
            ]);
        }

        // throw new MenuDoesntExistException($key);
    }
}
