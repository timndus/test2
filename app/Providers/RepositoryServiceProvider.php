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
            'App\Repositories\Redis\Default\AccountRepository'
        );
        // # end Account

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
