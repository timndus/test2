<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\App;
use App\Jobs\BackupAccountMedia;
use Facades\App\Interfaces\Repositories\Default\IAccountRepository as AccountRepository;

class JobStart extends Command
{
    protected $signature = 'job:start {name}';

    protected $description = 'Starts a job. job:start JobClassName';

    public function __construct(
    ) {
        parent::__construct();
    }
    
    /**
     * just dispatching a job
     *
     * @return void
     */
    public function handle() {
        $name = $this->argument('name');
        switch ($name) {
            case 'BackupAccountMedia':
                $this->info('Dispatching BackupAccountMedia job ...');
                $account_id_list = AccountRepository::getIdList();
                foreach ($account_id_list as $account_id) {
                    dispatch(App::make(BackupAccountMedia::class, ['account_id' => $account_id]));
                    $this->info('BackupAccountMedia #' . $account_id . ' dispatched');
                }

                $this->info('BackupAccountMedia dispatched');
                break;
            
            default:
                # code...
                break;
        }

    }
}