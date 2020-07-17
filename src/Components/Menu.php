<?php

namespace Paksuco\Menu\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Paksuco\Menu\MenuManager;

class Menu extends Component
{

    /**
     * The key of the menu
     *
     * @var string
     */
    public $key;

    /**
     * The Menu Manager
     *
     * @var MenuManager
     */
    public $menuManager;

    /**
     * The theme to render the menu with
     *
     * @var string
     */
    public $theme;

    /**
     * Shows when the menu children will open on mouse hover
     *
     * @var bool
     */
    public $hoverable;

    public $style;

    public $class;

    /**
     * Create the component instance.
     *
     * @param  MenuManager  $menuManager
     * @return void
     */
    public function __construct(MenuManager $menuManager, string $key, string $theme = "default", bool $hoverable = false, string $style = null, string $class = null)
    {
        $this->menuManager = $menuManager;
        $this->key = $key;
        $this->theme = $theme ?? "default";
        $this->hoverable = $hoverable;
        $this->style = $style . "";
        $this->class = $class . "";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('paksuco::menu', [
            "manager" => $this->menuManager,
            "key" => $this->key,
            "theme" => $this->theme,
            "hoverable" => $this->hoverable,
            "style" => $this->style,
            "class" => $this->class
        ]);
    }
}
