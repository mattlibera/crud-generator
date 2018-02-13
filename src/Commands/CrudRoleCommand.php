<?php

namespace Appzcoder\CrudGenerator\Commands;

use Illuminate\Console\GeneratorCommand;

class CrudRoleCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:role
                            {name : The name of the model.}
                            {package : The name of the package to which to bind these roles.}
                            {--roles= : JSON string for custom roles.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new seeder for a new role based on CRUD access to a model.';

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
        ? config('crudgenerator.path') . '/role-seeder.stub'
        : __DIR__ . '/../stubs/role-seeder.stub';
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
        $roleName = snake_case($model);

        $stub = $this->files->get($this->getStub());

        $roles = $this->option('roles') ? json_decode($this->option('roles'), true) : [
            [
                'name' => $roleName . '.viewer',
                'display_name' => ucwords($model) . ' - Viewer',
                'description' => 'Can view ' . str_plural($model),
            ],
            [
                'name' => $roleName . '.editor',
                'display_name' => ucwords($model) . ' - Editor',
                'description' => 'Can create, edit, and delete ' . str_plural($model),
            ],
        ];

        $ret = $this->replaceClassName($stub, ucwords($model))
            ->replaceRoles($stub, $roles)
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
        return base_path('database/seeds/' . ucwords($this->argument('name')) . 'RolesSeeder.php');
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
     * Replace the roles array for the given stub.
     *
     * @param  string  $stub
     * @param  array  $rolesArray
     *
     * @return $this
     */
    protected function replaceRoles(&$stub, $rolesArray)
    {
        $replaceString = '[';
        foreach($rolesArray as $role) {
            $replaceString .= "
            [
                'name' => '{$role['name']}',
                'display_name' => '{$role['display_name']}',
                'description' => '{$role['description']}',
            ],";
        }
        $replaceString .= '
        ]';

        $stub = str_replace('{{rolesArray}}', $replaceString, $stub);

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
