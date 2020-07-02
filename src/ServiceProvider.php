<?php

namespace Paksuco\Menu;

use Components\Menu;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->handleViewComponents();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('MenuManager', function($app){
            return new MenuManager();
        });
    }

    /**
     * Register the view components
     */
    private function handleViewComponents()
    {
        $this->loadViewComponentsAs("paksuco", [Menu::class]);
    }
}
