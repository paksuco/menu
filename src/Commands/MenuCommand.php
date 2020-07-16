<?php

namespace Paksuco\Menu\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MenuCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:menu {menu}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Menu class';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param  \App\DripEmailer  $drip
     * @return mixed
     */
    public function handle()
    {
        $menuName = trim($this->argument('menu') . "");

        if (empty($menuName)) {
            $this->error("You should enter a menu name.");
            return;
        }

        $className = Str::endsWith($menuName, 'Menu') ? Str::studly($menuName) : Str::studly($menuName) . "Menu";

        if (preg_match('/^[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*$/', $className) === 0) {
            $this->error("You should enter a valid menu name.");
            return;
        }

        $stub = file_get_contents(__DIR__ . "/MenuClass.stub");

        $stub = str_replace("%%NAMESPACE%%", app()->getNamespace() . "Menus", $stub);
        $stub = str_replace("%%CLASSNAME%%", $className, $stub);
        $stub = str_replace("%%MENUKEY%%", Str::kebab($menuName), $stub);

        if (!file_exists(app_path() . "/Menus")) {
            mkdir(app_path() . "/Menus", 0755, true);
        }

        if (file_exists(app_path() . "/Menus/" . ucfirst($className) . ".php")) {
            $this->error("Menu already exists!");
            return;
        }

        file_put_contents(app_path() . "/Menus/" . ucfirst($className) . ".php", $stub);

        $this->info("Menu class created!");
    }
}
