<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PatternDelete extends Command
{
    protected $signature = 'pattern:delete {name}';

    protected $description = 'Delete pattern';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = ucfirst($this->argument('name'));
        
        unlink(__DIR__ . '/../../Http/Controllers/Api/Default/' . $name . 'Controller.php');
     
        unlink(__DIR__ . '/../../Settings/Default/' . $name . 'Setting.php');
        unlink(__DIR__ . '/../../Settings/' . $name . 'Setting.php');

        unlink(__DIR__ . '/../../Interfaces/Repositories/Default/I' . $name . 'Repository.php');

        unlink(__DIR__ . '/../../Repositories/Redis/Default/' . $name . 'Repository.php');
        unlink(__DIR__ . '/../../Repositories/Redis/' . $name . 'Repository.php');

        unlink(__DIR__ . '/../../Repositories/T' . $name . 'Repository.php');
    }
}