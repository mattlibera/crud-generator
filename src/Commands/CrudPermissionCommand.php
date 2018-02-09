<?php

namespace Appzcoder\CrudGenerator\Commands;

use Illuminate\Console\GeneratorCommand;

class CrudPermissionCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:permission
                            {name : The name of the model.}
                            {package : The name of the package to which to bind these permissions.}
                            {--permissions= : JSON string for custom permissions.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new seeder for basic CRUD operations on a model.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Seeder';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return config('crudgenerator.custom_template')
        ? config('crudgenerator.path') . '/permission-seeder.stub'
        : __DIR__ . '/../stubs/permission-seeder.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }

    /**
     * Build the model class with the given name.
     *
     * @param  string  $name
     *
     * @return string
     */
    protected function buildClass($name)
    {
        $model = $this->argument('name');

        $stub = $this->files->get($this->getStub());

        $permissions = $this->option('permissions') ? json_decode($this->option('permissions'), true) : [
            $model . '.create' => 'Create ' . str_plural($model),
            $model . '.read' => 'Read / View ' . str_plural($model),
            $model . '.update' => 'Update / Edit ' . str_plural($model),
            $model . '.delete' => 'Delete ' . str_plural($model),
        ];

        $permissionsAsString = "$permissions";

        $ret = $this->replacePermissions($stub, $permissionsAsString)
            ->replacePackageName($stub, $this->argument('package'));

        return $ret->replaceClass($stub, $name);
    }

    /**
     * Replace the permissions array for the given stub.
     *
     * @param  string  $stub
     * @param  string  $permissionsArray
     *
     * @return $this
     */
    protected function replacePermissions(&$stub, $permissionsArray)
    {
        $stub = str_replace('{{permissionsArray}}', $permissionsArray, $stub);

        return $this;
    }

    /**
     * Replace the package name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $packageName
     *
     * @return $this
     */
    protected function replacePackageName(&$stub, $packageName)
    {
        $stub = str_replace('{{packageName}}', $packageName, $stub);

        return $this;
    }

}
