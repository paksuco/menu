<?php

namespace Paksuco\Menu;

use Illuminate\Support\Facades\Event;
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
        $this->app->singleton(MenuManager::class, function () {
            return MenuManager::getInstance();
        });
    }

    /**
     * Register the view components
     */
    private function handleViewComponents()
    {
        $this->loadViewsFrom(__DIR__ . '/../views/', 'paksuco');
        $this->loadViewComponentsAs("paksuco", [Components\Menu::class]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [MenuManager::class];
    }
}
