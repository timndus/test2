<?php

namespace App\Services;

use App\Settings\FileSystemSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FileSystemService implements \App\Interfaces\Services\IFileSystemService
{
    public function __construct(
        private FileSystemSetting $setting
    ) {}

    public function createDirectory(string $path): void {
        if(File::isDirectory(__DIR__ . '/../../storage/app' . $path)) {
            err($this->setting::HTTP_CODE_CONFLICT, $this->setting::DIRECTORY_EXISTS);
        }

        if(!Storage::makeDirectory($path)) {
            err($this->setting::HTTP_CODE_INTERNAL_SERVER_ERROR, $this->setting::INTERNAL_SERVER_ERROR);
        }
    }

    public function createFile(string $path): void {
        if(File::isFile(__DIR__ . '/../../storage/app' . $path)) {
            err($this->setting::HTTP_CODE_CONFLICT, $this->setting::FILE_EXISTS);
        }

        if(!Storage::put($path, 'test')) {
            err($this->setting::HTTP_CODE_INTERNAL_SERVER_ERROR, $this->setting::INTERNAL_SERVER_ERROR);
        }
    }

    public function getDirectoryList(string $path): array {
        return Storage::directories($path);
    }

    public function getFileList(string $path): array {
        return Storage::files($path);
    }
}