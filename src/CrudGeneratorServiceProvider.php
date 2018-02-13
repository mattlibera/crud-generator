<?php

namespace Mattlibera\CrudGenerator;

use Illuminate\Support\ServiceProvider;

class CrudGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/crudgenerator.php' => config_path('crudgenerator.php'),
        ]);

        $this->publishes([
            __DIR__ . '/../publish/views/' => base_path('resources/views/'),
        ]);

        if (\App::VERSION() <= '5.2') {
            $this->publishes([
                __DIR__ . '/../publish/css/app.css' => public_path('css/app.css'),
            ]);
        }

        $this->publishes([
            __DIR__ . '/stubs/' => base_path('resources/crud-generator/'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands(
            'Mattlibera\CrudGenerator\Commands\CrudCommand',
            'Mattlibera\CrudGenerator\Commands\CrudControllerCommand',
            'Mattlibera\CrudGenerator\Commands\CrudModelCommand',
            'Mattlibera\CrudGenerator\Commands\CrudMigrationCommand',
            'Mattlibera\CrudGenerator\Commands\CrudViewCommand',
            'Mattlibera\CrudGenerator\Commands\CrudLangCommand',
            'Mattlibera\CrudGenerator\Commands\CrudApiCommand',
            'Mattlibera\CrudGenerator\Commands\CrudApiControllerCommand',
            'Mattlibera\CrudGenerator\Commands\CrudRoleCommand',
            'Mattlibera\CrudGenerator\Commands\CrudPermissionCommand',
            'Mattlibera\CrudGenerator\Commands\CrudAclMigrationCommand',
            'Mattlibera\CrudGenerator\Commands\CrudAclCommand'
        );
    }
}
