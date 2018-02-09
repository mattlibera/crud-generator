<?php

namespace Appzcoder\CrudGenerator\Commands;

use Illuminate\Console\GeneratorCommand;

class CrudAclMigrationCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:acl-migration
                            {name : The name of the model.}
                            {package : The name of the package to which the ACL permissions and roles are bound.}';
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
    protected $type = 'Seeder';

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
        return $rootNamespace . '\\' . 'Seeders';
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

        // TODO - attachment logic
        $attachmentLogic = <<<EOD

EOD;


        $ret = $this->replaceClassName($stub, ucwords($model))
            ->replaceAttachmentLogic($stub, $attachmentLogic);

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
    protected function replaceAttachmentLogic(&$stub, $attachmentLogic)
    {
        $stub = str_replace('{{attachmentLogic}}', $attachmentLogic, $stub);

        return $this;
    }

}
