<?php

namespace Tests\Unit;

use App\Services\MainService;
use Tests\TestCase;

use Facades\App\Interfaces\Services\IFileSystemService as FileSystemService;

class DirectoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_directory_can_be_created() {
        $dir_name = MainService::generateRandomString(16);

        $path = base_path() . '/storage/app/opt/myprogram/' . $dir_name;
        FileSystemService::createDirectory($path);

        $this->assertDirectoryExists(base_path() . '/storage/app/opt/myprogram/' . $dir_name);
    }
}
