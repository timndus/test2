<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Account;
use App\Services\MainService;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $account = Account::factory()->create([
            'username' => 'parspack',
            'password' => '123456',
            'created_at' => MainService::getCurrentEpoch()
        ]);

        echo 'account #' . $account->id . ' created' . PHP_EOL;
    }
}
