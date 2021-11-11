<?php

namespace Database\Seeders;

use App\Interfaces\Repositories\Default\IAccountRepository;
use Illuminate\Database\Seeder;
use App\Services\MainService;

class AccountSeeder extends Seeder
{
    public function __construct(
        private IAccountRepository $accountRepository
    ) {}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $account = Account::factory()->create([
        //     'username' => 'parspack',
        //     'password' => '123456',
        //     'created_at' => MainService::getCurrentEpoch()
        // ]);

        $id = $this->accountRepository->create('parspack', '123456');
        echo 'account #' . $id . ' created' . PHP_EOL;
    }
}
