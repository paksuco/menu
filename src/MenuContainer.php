<?php

namespace Paksuco\Menu;

use Illuminate\Support\Collection;
use Paksuco\Menu\Exceptions\InvalidTypeException;

class MenuContainer extends Collection
{
    /**
     * Array containing the UL and LI classes
     *
     * @var array
     */
    private $containerClasses;

    /**
     * Array containing the link and chevron classes
     *
     * @var array
     */
    private $itemClasses;

    /**
     * The theme used when rendering the menu
     *
     * @var string
     */
    private $theme = "default";

    public function addItem(string $title, string $link, string $icon = "", callable $callback = null)
    {
        $menuItem = MenuItem::create($title, $link, $icon);
        $menuItem->getChildren()
            ->setStyles($this->containerClasses, $this->itemClasses)
            ->setTheme($this->theme);
        $this->push($menuItem);
        if ($callback) {
            $callback($menuItem->getChildren());
        }
        return $this;
    }

    public function hasItem(string $title)
    {
        return collect($this->items)->filter(function ($menuitem) use ($title) {
            return $menuitem->getTitle() === $title;
        })->count() > 0;
    }

    public function getChildren(string $title)
    {
        return collect($this->items)->filter(function ($menuitem) use ($title) {
            return $menuitem->getTitle() === $title;
        })->first()->getChildren() ?? null;
    }

    /**
     * Create a new collection.
     *
     * @param  mixed  $items
     * @return void
     */
    public function __construct($items = [])
    {
        $this->items = [];
        $items = $this->getArrayableItems($items);
        foreach ($items as $value) {
            if ($value instanceof MenuItem) {
                $this->items[] = $value;
            } else {
                throw new InvalidTypeException();
            }
        }
    }

    /**
     * Push one or more items onto the end of the collection.
     *
     * @param  mixed  $values [optional]
     * @return $this
     */
    public function push(...$values)
    {
        foreach ($values as $value) {
            if ($value instanceof MenuItem) {
                $this->items[] = $value;
            } else {
                throw new InvalidTypeException();
            }
        }

        return $this;
    }

    public function setStyles($containerClasses, $itemClasses)
    {
        $this->containerClasses = $containerClasses;
        $this->itemClasses = $itemClasses;
        return $this;
    }

    public function setTheme($theme)
    {
        $this->theme = $theme;
        return $this;
    }

    public function getIconClass($level)
    {
        if (!is_array($this->itemClasses)) {
            return "";
        }

        if (!isset($this->itemClasses[$this->theme])) {
            return "";
        }

        if (isset($this->itemClasses[$this->theme][$level]) && isset($this->itemClasses[$this->theme][$level]["icon"])) {
            return $this->itemClasses[$this->theme][$level]["icon"];
        }

        if (isset($this->itemClasses[$this->theme]["n"]) && isset($this->itemClasses[$this->theme]["n"]["icon"])) {
            return $this->itemClasses[$this->theme]["n"]["icon"];
        }

        return "";
    }

    public function getLinkClass($level)
    {
        if (!is_array($this->itemClasses)) {
            return "";
        }

        if (!isset($this->itemClasses[$this->theme])) {
            return "";
        }

        if (isset($this->itemClasses[$this->theme][$level]) && isset($this->itemClasses[$this->theme][$level]["link"])) {
            return $this->itemClasses[$this->theme][$level]["link"];
        }

        if (isset($this->itemClasses[$this->theme]["n"]) && isset($this->itemClasses[$this->theme]["n"]["link"])) {
            return $this->itemClasses[$this->theme]["n"]["link"];
        }

        return "";
    }

    public function getLIClass($level, $childrenCount)
    {
        if (!is_array($this->containerClasses)) {
            return "";
        }

        if (!isset($this->containerClasses[$this->theme])) {
            return "";
        }

        $key = $childrenCount > 0 ? "liWithChildren" : "liWithoutChildren";
        if (isset($this->containerClasses[$this->theme][$level]) && isset($this->containerClasses[$this->theme][$level][$key])) {
            return $this->containerClasses[$this->theme][$level][$key];
        }

        if (isset($this->containerClasses[$this->theme]["n"]) && isset($this->containerClasses[$this->theme]["n"][$key])) {
            return $this->containerClasses[$this->theme]["n"][$key];
        }

        return "";
    }

    public function getULClass($level)
    {
        echo "menu-theme-{$this->theme} ";

        if (!is_array($this->containerClasses)) {
            return "";
        }

        if (!isset($this->containerClasses[$this->theme])) {
            return "";
        }

        if (isset($this->containerClasses[$this->theme][$level]) && isset($this->containerClasses[$this->theme][$level]["ulClass"])) {
            return $this->containerClasses[$this->theme][$level]["ulClass"] . " z-" . ($level * 10);
        }

        if (isset($this->containerClasses[$this->theme]["n"]) && isset($this->containerClasses[$this->theme]["n"]["ulClass"])) {
            return $this->containerClasses[$this->theme]["n"]["ulClass"] . " z-" . ($level * 10);
        }

        return "";
    }
}
