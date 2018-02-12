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
        return $rootNamespace . '\\' . 'Seeders';
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
            [
                'name' => $model . '.create',
                'display_name' => ucwords($model) . ' - Create',
                'description' => 'Create ' . str_plural($model),
            ],
            [
                'name' => $model . '.read',
                'display_name' => ucwords($model) . ' - Read',
                'description' => 'Read / View ' . str_plural($model),
            ],
            [
                'name' => $model . '.update',
                'display_name' => ucwords($model) . ' - Update',
                'description' => 'Update / Edit ' . str_plural($model),
            ],
            [
                'name' => $model . '.delete',
                'display_name' => ucwords($model) . ' - Delete',
                'description' => 'Delete ' . str_plural($model),
            ],
        ];

        $ret = $this->replaceClassName($stub, ucwords($model))
            ->replacePermissions($stub, $permissions)
            ->replacePackageName($stub, $this->argument('package'));

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
        return base_path('database/seeds/' . ucwords($this->argument('name')) . 'PermissionsSeeder.php');
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

    /**
     * Replace the permissions array for the given stub.
     *
     * @param  string  $stub
     * @param  array  $permissionsArray
     *
     * @return $this
     */
    protected function replacePermissions(&$stub, $permissionsArray)
    {
        $replaceString = '[';
        foreach($permissionsArray as $permission) {
            $replaceString .= "
        [
            'name' => '{$permission['name']}',
            'display_name' => '{$permission['display_name']}',
            'description' => '{$permission['description']}',
        ],";
        }
        $replaceString .= '
    ]';

        $stub = str_replace('{{permissionsArray}}', $replaceString, $stub);

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
