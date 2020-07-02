<?php

namespace Paksuco\Menu;

use Illuminate\View\Component;

class Menu extends Component
{
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
    public function __construct(MenuManager $menuManager)
    {
        $this->menuManager = $menuManager;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('paksuco-menu.menu', ["menuManager" => $this->menuManager]);
    }
}