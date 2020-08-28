<?php

namespace Paksuco\Menu;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Paksuco\Menu\Commands\MenuCommand;
use Paksuco\Menu\Contracts\Menu;
use ReflectionClass;
use Symfony\Component\Finder\Finder;

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
        $this->handleMenus();
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

    private function handleMenus()
    {
        $this->callAfterResolving(MenuManager::class, function () {
            foreach (Finder::create()->files()->name('*.php')->in(app_path("Menus")) as $file) {
                require $file->getRealPath();
                $className = Str::replaceLast('.php', '', basename($file));
                $classNameWithNamespace = "\\" . app()->getnamespace() . "Menus\\" . $className;
                $classInfo = new ReflectionClass($classNameWithNamespace);
                if ($classInfo->getParentClass()->name === Menu::class) {
                    app()->make($classNameWithNamespace);
                }
            }
        });
    }

    /**
     * Register the view components
     */
    private function handleViewComponents()
    {
        $this->publishes([__DIR__ . '/../views' => base_path('resources/views/vendor/paksuco-menu')]);

        $this->loadViewsFrom(__DIR__ . '/../views/', 'paksuco-menu');
        $this->loadViewComponentsAs("paksuco-menu", [ Components\Menu::class ]);
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
