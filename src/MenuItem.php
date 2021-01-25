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
    protected $badge;

    private function __construct()
    {
        // prevent instantiation
    }

    public static function create(string $title, string $link, string $icon = "", $priority = 100, $badge = null)
    {
        $instance = new static;
        $instance->title = $title;
        $instance->link = $link;
        $instance->icon = $icon;
        $instance->children = new MenuContainer();
        $instance->priority = $priority;
        $instance->badge = $badge;
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
        return __($this->title);
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getBadge()
    {
        return $this->badge;
    }

    public function setBadge(string $badge)
    {
        $this->badge = $badge;
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
