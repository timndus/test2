<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Services\MainService;
use Facades\App\Interfaces\Repositories\Default\IAccountRepository as AccountRepository;
use Facades\App\Interfaces\Services\Default\IFileService as FileService;
use Facades\App\Interfaces\Services\IFileSystemService as FileSystemService;

class BackupAccountMedia implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public string $account_id
    ) {}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        // /opt/backups/username/y-m-d.zip
        $account = AccountRepository::findOrFail($this->account_id);
        
        $file_list = FileService::getList($this->account_id);
        $path = base_path() . '/storage/app/opt/backups/' . $account['username'];
        $name = MainService::getCurrentEpoch(false) . '.zip';
        FileSystemService::createZip($file_list, $path, $name);
    }
}
