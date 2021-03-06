<?php

namespace Uncgits\CrudGenerator\Commands;

use Illuminate\Console\Command;

class CrudAclCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:acl
                            {name : The name of the model.}
                            {package : The name of the package to which to bind these roles.}
                            {--roles= : JSON string for custom roles.}
                            {--permissions= : JSON string for custom permissions.}
                            {--admin-role=yes : Also bind permissions to a role named "admin".}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate CRUD permissions / roles and an ACL migration for a model';

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
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $package = $this->argument('package');

        $roleArgumentsAndOptions = [
            'name' => $name,
            'package' => $package,
        ];
        if ($this->option('roles')) {
            $roleArgumentsAndOptions['--roles'] = $this->option('roles');
        }

        $this->line('Generating role seeder...');
        $this->call('crud:role', $roleArgumentsAndOptions);

        $permissionArgumentsAndOptions = [
            'name' => $name,
            'package' => $package,
        ];
        if ($this->option('permissions')) {
            $permissionArgumentsAndOptions['--permissions'] = $this->option('permissions');
        }

        $this->line('Generating permission seeder...');
        $this->call('crud:permission', $permissionArgumentsAndOptions);

        $aclArgumentsAndOptions = [
            'name' => $name
        ];
        if ($this->option('admin-role')) {
            $aclArgumentsAndOptions['--admin-role'] = $this->option('admin-role');
        }

        $this->line('Generating migration file...');
        $this->call('crud:acl-migration', $aclArgumentsAndOptions);

        $this->line('Dumping autoload...');
        $this->call('ccps:dump-autoload');
        $this->line('Done.');

        $this->info('ACL classes and migration created. Run `php artisan migrate` to apply changes to database.');

        return true;
    }

}
