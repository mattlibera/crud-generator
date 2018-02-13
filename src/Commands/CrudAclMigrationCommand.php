<?php

namespace Mattlibera\CrudGenerator\Commands;

use Illuminate\Console\GeneratorCommand;
use Carbon\Carbon;

class CrudAclMigrationCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:acl-migration
                            {name : The name of the model.}
                            {--bindings : Custom array of role=>permissionArray bindings to use.}
                            {--admin-role=yes : Also bind permissions to a role named "admin".}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a database migration to attach roles to permissions.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Migration';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return config('crudgenerator.custom_template')
        ? config('crudgenerator.path') . '/acl-migration.stub'
        : __DIR__ . '/../stubs/acl-migration.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\\' . 'Migrations';
    }

    /**
     * Build the migration class with the given name.
     *
     * @param  string  $name
     *
     * @return string
     */
    protected function buildClass($name)
    {
        $model = $this->argument('name');

        $stub = $this->files->get($this->getStub());

        $bindings = $this->option('bindings') ?: [
            $model . '.viewer' => [
                $model . '.read'
            ],
            $model . '.editor' => [
                $model . '.create',
                $model . '.update',
                $model . '.delete',
            ]
        ];

        if ($this->option('admin-role') == 'yes') {
            $bindings['admin'] = [
                $model . '.create',
                $model . '.read',
                $model . '.update',
                $model . '.delete',
            ];
        }

        $ret = $this->replaceBindings($stub, $bindings)
            ->replaceClassName($stub, ucwords($model));

        return $ret->replaceClass($stub, $name);
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        return base_path('database/migrations/' . Carbon::now()->format('Y_m_d_his') . '_add_' . strtolower($this->argument('name')) . '_roles_and_permissions.php');
    }

    /**
     * Replace the role/permission bindings for the given stub.
     *
     * @param  string  $stub
     * @param  array  $bindings
     *
     * @return $this
     */
    protected function replaceBindings(&$stub, $bindings)
    {
        $replaceString = '[';
        foreach($bindings as $role => $permissions) {
            $role = snake_case($role);
            $replaceString .= "
            '$role' => [";
            foreach($permissions as $permission) {
                $permission = snake_case($permission);
                $replaceString .= "
                '$permission',";
            }
            $replaceString .= '
            ],';


        }
        $replaceString .= '
        ];';


        $stub = str_replace('{{bindings}}', $replaceString, $stub);

        return $this;
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $className
     *
     * @return $this
     */
    protected function replaceClassName(&$stub, $className)
    {
        $stub = str_replace('{{className}}', $className, $stub);

        return $this;
    }

}
