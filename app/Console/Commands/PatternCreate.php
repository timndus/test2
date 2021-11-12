<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PatternCreate extends Command
{
    protected $signature = 'pattern:create {name}';

    protected $description = 'Creating my customized structure';

    protected $name;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->name = ucfirst($this->argument('name'));

        /** Controllers */
        $path = __DIR__ . '/../../Http/Controllers/Api/Default';
        $this->makeController($path);

        /** Repository Interfaces */
        $path = __DIR__ . '/../../Interfaces/Repositories/Default';
        $this->makeRepositoryInterface($path);
        
        /** Repositories */
        $path = __DIR__ . '/../../Repositories/Redis/Default';
        $this->makeRepository($path);

        $path = __DIR__ . '/../../Repositories/Redis';
        $this->makeRepository($path);

        /** Repository Traits */
        $path = __DIR__ . '/../../Repositories';
        $this->makeRepositoryTrait($path);

        /** Settings */
        $path = __DIR__ . '/../../Settings/Default';
        $this->makeSetting($path);

        $path = __DIR__ . '/../../Settings';
        $this->makeSetting($path);

        /** Binding */
        $this->addBinding();
    }

    private function makeController($path) {
        $content = file_get_contents($path . '/ExampleController.php');
        $content = str_replace('Example', $this->name, $content);
        $content = str_replace('example', strtolower($this->name), $content);
        file_put_contents($path . '/' . $this->name . 'Controller.php', $content);
    }

    private function makeRepositoryInterface($path) {
        $content = file_get_contents($path . '/IExampleRepository.php');
        $content = str_replace('Example', $this->name, $content);
        file_put_contents($path . '/I' . $this->name . 'Repository.php', $content);
    }

    private function makeRepositoryTrait($path) {
        $content = file_get_contents($path . '/TExampleRepository.php');
        $content = str_replace('Example', $this->name, $content);
        file_put_contents($path . '/T' . $this->name . 'Repository.php', $content);
    }

    private function makeRepository($path) {
        $content = file_get_contents($path . '/ExampleRepository.php');
        $content = str_replace('Example', $this->name, $content);
        file_put_contents($path . '/' . $this->name . 'Repository.php', $content);
    }

    private function makeSetting($path) {
        $content = file_get_contents($path . '/ExampleSetting.php');
        $content = str_replace('Example', $this->name, $content);
        file_put_contents($path . '/' . $this->name . 'Setting.php', $content);
    }
 
    private function addBinding() {
        $binding = '// # start ' . $this->name .
        PHP_EOL . "\t\t" .
        '$this->app->bind(
            \'App\\Interfaces\\Repositories\\Default\\I' . $this->name . 'Repository\',
            \'App\\Repositories\\Redis\\Default\\' . $this->name . 'Repository\'
        );
        // # end ' . $this->name . PHP_EOL . PHP_EOL . "\t\t";

        $content = file_get_contents(__DIR__ . '/../../Providers/RepositoryServiceProvider.php');

        $pos = strpos($content, '// # pattern:create');
        $newstr = substr_replace($content, $binding, $pos, 0);

        file_put_contents(__DIR__ . '/../../Providers/RepositoryServiceProvider.php', $newstr);
    }

}