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
        $this->handleViews();
        $this->handleViewComponents();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Bind any implementations.
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function handleViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../views', 'paksuco-menu');

        $this->publishes([__DIR__ . '/../views' => base_path('resources/views/paksuco/menu')]);
    }

    private function handleViewComponents()
    {
        $this->loadViewComponentsAs("paksuco", [Menu::class]);
    }
}
