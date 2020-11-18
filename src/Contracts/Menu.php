<?php

namespace Paksuco\Menu\Contracts;

use Illuminate\Support\Facades\Event;
use Paksuco\Menu\Exceptions\InvalidKeyException;
use Paksuco\Menu\MenuContainer;
use Paksuco\Menu\MenuManager;

/**
 * Abstract class for creating renderable menu objects
 */
abstract class Menu
{
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

    protected $menuContainerClasses = [
        "default" => [
            0 => [
                "ulClass" => "flex w-full",
                "liWithoutChildren" => "p-0 border border-l-0 pr-2 relative",
                "liWithChildren" => "p-0 border border-l-0 pr-6 relative",
            ],
            1 => [
                "ulClass" => "bg-white border rounded-sm absolute top-full left-0",
                "liWithoutChildren" => "p-0 relative border-b",
                "liWithChildren" => "p-0 relative border-b",
            ],
            "n" => [
                "ulClass" => "p-3 sm:p-0 absolute left-full top-0 flex flex-col sm:flex-row",
                "liWithoutChildren" => "p-0 relative border-b",
                "liWithChildren" => "p-0 relative border-b",
            ],
        ],
    ];

    protected $menuItemClasses = [
        "default" => [
            0 => [
                "link" => "block p-2 px-3 text-gray-700 group-hover:text-gray-500 whitespace-no-wrap",
                "arrow" => "fa fa-chevron-down p-2 text-sm absolute inset-y-0 text-gray-700 group-hover:text-gray-500 right-2 flex items-center justify-center origin-center pointer-events-none",
                "icon" => "",
            ],
            "n" => [
                "link" => "block p-2 px-3 text-gray-700 group-hover:text-gray-900 whitespace-no-wrap",
                "arrow" => "fa fa-chevron-right text-sm absolute inset-y-0 text-white group-hover:text-gray-400 right-2 flex items-center justify-center origin-center pointer-events-none",
                "icon" => "",
            ],
        ],
    ];

    public function __construct()
    {
        if (empty($this->key)) {
            throw new InvalidKeyException();
        }

        $this->menu = new MenuContainer();
        $this->menu->setStyles(
            $this->menuContainerClasses,
            $this->menuItemClasses
        )->setTheme("default");

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

    public function dump(
        string $theme,
        bool $hoverable = false,
        bool $showActive = false,
        bool $activeVisible = false
    ) {
        // Enable other classes to extend the menu items
        $container = $this->getContainer();
        $container->setTheme($theme);

        $random = \Illuminate\Support\Str::random(8);

        Event::dispatch("paksuco.menu.beforeRender", [
            "key" => $this->getKey(),
            "container" => $container,
        ]);

        $container->setActiveClasses();

        return view("paksuco-menu::menucontainer", [
            "container" => $container,
            "level" => 0,
            "theme" => $theme,
            "random" => $random,
            "hoverable" => $hoverable,
            "showActive" => $showActive,
            "activeVisible" => $activeVisible,
        ]);
    }
}
