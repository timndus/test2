<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Services\MainService;

use Facades\App\Interfaces\Repositories\Default\IAccountRepository as AccountRepository;

class AccountTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_account_can_be_created() {
        $username = MainService::generateRandomString(16);
        $password = '123456';

        $response = $this->post('/api/v1/account', [
            'username' => $username,
            'password' => $password,
        ]);
        $response->assertStatus(201);

        $this->assertDirectoryExists(
            base_path() . '/storage/app/opt/myprogram/' . $username,
            "home directory doesn't exists"
        );
    }
}
