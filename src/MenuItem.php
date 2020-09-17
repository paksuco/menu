<?php

namespace Paksuco\Menu;

class MenuItem
{

    protected $title;
    protected $icon;
    protected $link;
    protected $children;
    public $priority;
    public $active = false;

    private function __construct()
    {
        // prevent instantiation
    }

    public static function create(string $title, string $link, string $icon = "", $priority = 100)
    {
        $instance = new static;
        $instance->title = $title;
        $instance->link = $link;
        $instance->icon = $icon;
        $instance->children = new MenuContainer();
        $instance->priority = $priority;
        return $instance;
    }

    public function build()
    {
        return view("paksuco-menu::menuitem", ["item" => $this]);
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
        return $this->children->sortBy("priority");
    }

    public function setChildren(MenuContainer $children)
    {
        $this->children = $children;
    }
}
