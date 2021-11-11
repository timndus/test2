<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
		// # start Account
		$this->app->bind(
            'App\Interfaces\Repositories\Default\IAccountRepository',
            'App\Repositories\QueryBuilder\Default\AccountRepository'
        );
        // # end Account

		// # start Auth
		$this->app->bind(
            'App\Interfaces\Repositories\Default\IAuthRepository',
            'App\Repositories\Redis\Default\AuthRepository'
        );
        // # end Auth

		// # pattern:create
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
		//
    }
}
