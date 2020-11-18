<?php

namespace Paksuco\Menu\Components;

use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * The key of the menu
     *
     * @var string
     */
    public $key;

    /**
     * The theme to render the menu with
     *
     * @var string
     */
    public $theme;

    /**
     * The menu instance
     *
     * @var Menu
     */
    public $instance;

    /**
     * Shows when the menu children will open on mouse hover
     *
     * @var bool
     */
    public $hoverable;

    public $style;

    public $class;

    public $title;

    public $titleClass;

    public $showActive;

    public $activeVisible;

    /**
     * Create the component instance.
     *
     * @return void
     */
    public function __construct(
        string $className,
        string $theme = "default",
        bool $hoverable = false,
        string $style = null,
        string $class = null,
        string $title = "",
        string $titleClass = "",
        bool $showActive = false,
        bool $activeVisible = false
    ) {
        $this->instance = new $className();
        $this->theme = $theme ?? "default";
        $this->hoverable = $hoverable;
        $this->style = $style . "";
        $this->class = $class . "";
        $this->title = $title . "";
        $this->titleClass = $titleClass . "";
        $this->showActive = !!$showActive;
        $this->activeVisible = !!$activeVisible;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('paksuco-menu::menu', [
            "instance" => $this->instance,
            "theme" => $this->theme,
            "hoverable" => $this->hoverable,
            "style" => $this->style,
            "class" => $this->class,
            "title" => $this->title,
            "titleClass" => $this->titleClass,
            "showActive" => $this->showActive,
            "activeVisible" => $this->activeVisible
        ]);
    }
}
