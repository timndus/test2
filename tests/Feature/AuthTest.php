<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Facades\App\Interfaces\Repositories\Default\IAccountRepository as AccountRepository;
use Facades\App\Interfaces\Repositories\Default\IAuthRepository as AuthRepository;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_account_can_authenticate() {
        $id_list = AccountRepository::getIdList();
        $account = AccountRepository::find($id_list[0]);

        $response = $this->post('/api/v1/auth', [
            'username' => $account['username'],
            'password' => $account['password'],
        ]);
        $response->assertStatus(201);
    }
}
