<?php

namespace Paksuco\Menu;

use Illuminate\Support\ServiceProvider;
use Paksuco\Menu\Commands\MenuCommand;

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
        $this->handleCommands();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Registers the artisan commands
     *
     * @return vpid
     */
    private function handleCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MenuCommand::class,
            ]);
        }
    }

    /**
     * Register the view components
     */
    private function handleViewComponents()
    {
        $this->publishes([__DIR__ . '/../views' => base_path('resources/views/vendor/paksuco-menu')], "views");

        $this->loadViewsFrom(__DIR__ . '/../views/', 'paksuco-menu');
        $this->loadViewComponentsAs("paksuco", [ Components\Menu::class ]);
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
}
