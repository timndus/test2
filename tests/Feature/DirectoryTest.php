<?php

namespace Tests\Feature;

use App\Services\MainService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DirectoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_account_can_create_directory() {
        $username = MainService::generateRandomString(16);
        $password = '123456';

        $response = $this->post('/api/v1/account', [
            'username' => $username,
            'password' => $password,
        ]);

        $response = $this->post('/api/v1/auth', [
            'username' => $username,
            'password' => $password,
        ]);

        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $response->json()['data']['token'])
            ->post('/api/v1/directory', [
                'name' => MainService::generateRandomString(16),
            ]);

        $response->assertStatus(201);
    }
}
