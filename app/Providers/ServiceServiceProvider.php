<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'App\Interfaces\Services\Default\IProcessService',
			'App\Services\Default\ProcessService'
		);

		$this->app->bind(
			'App\Interfaces\Services\Default\IDirectoryService',
			'App\Services\Default\DirectoryService'
		);

		$this->app->bind(
			'App\Interfaces\Services\IFileSystemService',
			'App\Services\FileSystemService'
		);
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
