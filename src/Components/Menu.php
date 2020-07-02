<?php

namespace Paksuco\Menu\Components;

use Illuminate\View\Component;
use Paksuco\Menu\MenuManager;

class Menu extends Component
{

    public $key;

    /**
     * The Menu Manager
     *
     * @var string
     */
    public $menuManager;

    /**
     * Create the component instance.
     *
     * @param  MenuManager  $menuManager
     * @return void
     */
    public function __construct(MenuManager $menuManager, string $key)
    {
        $this->key = $key;
        $this->menuManager = $menuManager;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('paksuco::menu', [
            "menuManager" => $this->menuManager,
            "key" => $this->key
        ]);
    }
}
