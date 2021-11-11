<?php

namespace App\Console\Commands;

use App\Services\MainService;
use Illuminate\Console\Command;

use Facades\App\Interfaces\Repositories\Default\IAccountRepository as AccountRepository;
use Facades\App\Interfaces\Services\Default\IFileService as FileService;
use Facades\App\Interfaces\Services\IFileSystemService as FileSystemService;

class CompressAccountMedia extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account:compress {id_list?*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a zip file of account(s) media';

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
     * @return int
     */
    public function handle()
    {
        $id_list = $this->argument('id_list');
        if(!$id_list) {
            $id_list = AccountRepository::getIdList();
        }

        foreach ($id_list as $id) {
            $file_list = FileService::getList($id);
    
            $path = base_path() . '/storage/app/opt/backups/' . 'a' . $id . '-' . MainService::getCurrentEpoch(false) . '.zip';
            FileSystemService::createZip($file_list, $path);
        }

        return Command::SUCCESS;
    }
}
