<?php #app/commands/CreateGroupCommand.php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateGroupCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'sentry:group';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new group.';

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
     * @todo Check if group already exists.
     * @return void
     */
    public function fire()
    {
        // Get the name of the group
        $name  = $this->argument('name');

        // Ask for the permissions of the group
        $this->info("0 : Deny\n1 : Allow");

        $perms      = array();
        $perms_list = $this->getPermissionsList();

        foreach ($perms_list as $perms_item) {
            $perms[$perms_item] = $this->ask("{$perms_item}=");
        }

        // Create the group
        $group = Sentry::getGroupProvider()->create(array(
            'name'        => $name,
            'permissions' => $perms,
        ));

        $this->info("{$name} group created!!");
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('name', InputArgument::REQUIRED, 'Group name.'),
        );
    }

    /**
     * Get the list of group permissions.
     *
     * @return array
     */
    protected function getPermissionsList()
    {
        return array(
            'user.create',
            'user.delete',
            'user.view',
            'user.update',
            'direcciones.create',
            'direcciones.delete',
            'direcciones.view',
            'direcciones.update',
            'dependencias.create',
            'dependencias.delete',
            'dependencias.view',
            'dependencias.update',
            'beneficiarios.create',
            'beneficiarios.delete',
            'beneficiarios.view',
            'beneficiarios.update',
            'organizaciones.create',
            'organizaciones.delete',
            'organizaciones.view',
            'organizaciones.update',
            'anos_fiscales.create',
            'anos_fiscales.delete',
            'anos_fiscales.view',
            'anos_fiscales.update',
            'beneficiarios_organizaciones.create',
            'beneficiarios_organizaciones.delete',
            'beneficiarios_organizaciones.view',
            'beneficiarios_organizaciones.update',
            'programas.create',
            'programas.delete',
            'programas.view',
            'programas.update',
            'inscripciones.create',
            'inscripciones.delete',
            'inscripciones.view',
            'inscripciones.update',
        );
    }

}