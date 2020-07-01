<?php

namespace Paksuco\Menu;

class MenuItem {

    private function  __construct(){
        // prevent instantiation
    }

    protected $title;
    protected $icon;
    protected $link;
    protected $children;

    public static function create(string $title, string $icon, string $link, MenuContainer $children = null) {
        $instance = new static;
        $instance->title = $title;
        $instance->icon = $icon;
        $instance->link = $link;
        $instance->children = $children;
        return $instance;
    }

    public function build()
    {
        return implode("", [
            "<a href='", $this->link, "'>", $this->title, $this->children ? $this->children->build() : "", "</a>"
        ]);
    }

    public function __toString()
    {
        return $this->build();
    }
}