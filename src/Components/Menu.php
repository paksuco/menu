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
     * Create the component instance.
     *
     * @param  MenuManager  $menuManager
     * @return void
     */
    public function __construct(MenuManager $menuManager, string $key, string $theme = "default")
    {
        $this->menuManager = $menuManager;
        $this->key = $key;
        $this->theme = $theme ?? "default";
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
            "theme" => $this->theme
        ]);
    }
}
