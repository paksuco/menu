<?php

namespace Paksuco\Menu;

class MenuManager
{

    /**
     * Collection of user-generated menu containers
     *
     * @var \Illuminate\Support\Collection
     */
    protected $menus = null;

    protected $stylesAppended = false;

    public function __construct()
    {
        $this->menus = collect();
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
