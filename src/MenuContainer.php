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

    public $active = false;

    public function addItem(string $title, string $link, string $icon = "", callable $callback = null, $priority = 100)
    {
        $menuItem = $this->getItem($title);

        if ($menuItem == null) {
            $menuItem = MenuItem::create($title, $link, $icon, $priority);

            $menuItem->getChildren()
                ->setStyles($this->containerClasses, $this->itemClasses)
                ->setTheme($this->theme);
            $this->push($menuItem);
        }

        if ($callback) {
            $callback($menuItem->getChildren());
        }

        return $this;
    }

    public function getItem(string $title)
    {
        return collect($this->items)->filter(function ($menuitem) use ($title) {
            return $menuitem->getTitle() === $title;
        })->first();
    }

    public function hasItem(string $title)
    {
        $this->getItem($title) === null;
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

    public function setActiveClasses()
    {
        $result = false;
        $url = request()->url();
        foreach ($this->items as $item) {
            $item->active = $item->getLink() == $url;
            $children = $item->getChildren();
            if (count($children->items) > 0) {
                $hasActiveChildren = $children->setActiveClasses();
                $item->active |= $hasActiveChildren;
                $item->active = !!$item->active;
            }
            $result |= $item->active;
            $result == !!$result;
        }
        $this->active = !!$result;
        return $result;
    }

    public function getIconClass($level)
    {
        return $this->getClass($this->itemClasses, $this->theme, $level, "icon", "");
    }

    public function getArrowClass($level)
    {
        return $this->getClass($this->itemClasses, $this->theme, $level, "arrow", "");
    }

    public function getLinkClass($level, $active)
    {
        $class = $this->getClass($this->itemClasses, $this->theme, $level, $active ? "active" : "link", "", true);

        if (!$class) {
            $class = $this->getClass($this->itemClasses, $this->theme, $level, "link", "");
        }

        return $class;
    }

    public function getTextClass($level)
    {
        return $this->getClass($this->itemClasses, $this->theme, $level, "text", "");
    }

    public function getLIClass($level, $childrenCount)
    {
        $key = $childrenCount > 0 ? "liWithChildren" : "liWithoutChildren";
        return $this->getClass($this->containerClasses, $this->theme, $level, $key, "");
    }

    public function getULClass($level)
    {
        return $this->getClass($this->containerClasses, $this->theme, $level, "ulClass", "menu-theme-{$this->theme} z-" . $level * 10);
    }

    private function getClass($container, $theme, $level, $key, $suffix, $return = false)
    {
        if (!is_array($container)) {
            return " " . $suffix;
        }

        if (!isset($container[$theme])) {
            return " " . $suffix;
        }

        if (isset($container[$theme][$level]) && isset($container[$theme][$level][$key])) {
            return $container[$theme][$level][$key] . " " . $suffix;
        }

        if (isset($container[$theme]["n"]) && isset($container[$theme]["n"][$key])) {
            return $container[$theme]["n"][$key] . " " . $suffix;
        }

        if ($return) {
            return false;
        }

        return " " . $suffix;
    }
}
