<?php

namespace Uncgits\CrudGenerator;

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
            'Uncgits\CrudGenerator\Commands\CrudCommand',
            'Uncgits\CrudGenerator\Commands\CrudControllerCommand',
            'Uncgits\CrudGenerator\Commands\CrudModelCommand',
            'Uncgits\CrudGenerator\Commands\CrudMigrationCommand',
            'Uncgits\CrudGenerator\Commands\CrudViewCommand',
            'Uncgits\CrudGenerator\Commands\CrudLangCommand',
            'Uncgits\CrudGenerator\Commands\CrudApiCommand',
            'Uncgits\CrudGenerator\Commands\CrudApiControllerCommand',
            'Uncgits\CrudGenerator\Commands\CrudRoleCommand',
            'Uncgits\CrudGenerator\Commands\CrudPermissionCommand',
            'Uncgits\CrudGenerator\Commands\CrudAclMigrationCommand',
            'Uncgits\CrudGenerator\Commands\CrudAclCommand'
        );
    }
}
