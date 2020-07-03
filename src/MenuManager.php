<?php

namespace Paksuco\Menu;

use Illuminate\Support\Facades\Event;

class MenuManager
{

    /**
     * Collection of user-generated menu containers
     *
     * @var \Illuminate\Support\Collection
     */
    protected $menus = null;

    protected static $instance = null;

    protected $stylesAppended = false;

    private function __construct()
    {
        $this->menus = collect();
    }

    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new static;
        }

        return self::$instance;
    }

    public function menu(string $menuKey): MenuContainer
    {
        return $this->exists($menuKey) ? $this->getMenuItem($menuKey) : $this->createMenu($menuKey);
    }

    public function exists(string $key): bool
    {
        return $this->menus->has($key);
    }

    protected function getMenuItem(string $key): MenuContainer
    {
        return $this->menus->get($key);
    }

    public function createMenu(string $key, $options = [])
    {
        $this->menus->put($key, new MenuContainer([], $options));
        return $this->menus->get($key);
    }

    public function dump(string $key)
    {
        Event::dispatch("paksuco.menu.beforeRender", [$this]);
        return view("paksuco::menucontainer", ["items" => $this->menus->get($key), "level" => 0]);
    }

    public function styles()
    {
        if ($this->stylesAppended === false) {
            $this->stylesAppended = true;
            return view("paksuco::menustyles");
        }
    }
}
