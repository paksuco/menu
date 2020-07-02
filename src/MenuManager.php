<?php

namespace Paksuco\Menu;

class MenuManager
{

    /**
     * Collection of user-generated menu containers
     *
     * @var Illuminate\Support\Collection
     */
    protected $menus = null;

    public function add(string $menuKey, string $title, string $link, string $iconClass = ""): MenuContainer
    {
        $menu = $this->get($menuKey);
        $menu->push(MenuItem::create($title, $iconClass, $link));
        return $menu;
    }

    protected function __construct()
    {
        $this->menus = collect();
    }

    protected function get(string $key): MenuContainer
    {
        if ($this->exists($key) === false) {
            $this->create($key);
        }

        return $this->getMenuItem($key);
    }

    protected function getMenuItem(string $key): MenuContainer
    {
        return $this->menus->get($key);
    }

    protected function exists(string $key): bool
    {
        return $this->menus->has($key);
    }

    protected function create(string $key)
    {
        return $this->menus->put($key, new MenuContainer);
    }

    protected function dump(string $key)
    {
        return $this->get($key)->build();
    }
}
