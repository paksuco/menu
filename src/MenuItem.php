<?php

namespace Paksuco\Menu;

class MenuItem
{

    protected $title;
    protected $icon;
    protected $link;
    protected $children;

    private function __construct()
    {
        // prevent instantiation
    }

    public static function create(string $title, string $icon, string $link, MenuContainer $children = null)
    {
        $instance = new static;
        $instance->title = $title;
        $instance->icon = $icon;
        $instance->link = $link;
        $instance->children = $children === null ? new MenuContainer() : $children;
        return $instance;
    }

    public function build()
    {
        return implode("", [
            "<a href='", $this->link, "'>", $this->title, $this->children ? $this->children->build() : "", "</a>",
        ]);
    }

    public function __toString()
    {
        return $this->build();
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getIconClass()
    {
        return $this->icon;
    }

    public function setIconClass(string $iconClass)
    {
        $this->icon = $iconClass;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setLink(string $link)
    {
        $this->link = $link;
    }

    public function getChildren() : MenuContainer
    {
        return $this->children;
    }

    public function setChildren(MenuContainer $children)
    {
        $this->children = $children;
    }
}
