<?php

namespace App\Services;

use App\Settings\Setting;
use Illuminate\Support\Facades\Storage;

class FileSystemService
{
    public function createDirectory(string $path): void {
        if(!Storage::makeDirectory($path)) {
            err(Setting::HTTP_CODE_INTERNAL_SERVER_ERROR, Setting::INTERNAL_SERVER_ERROR);
        }
    }

    public function getDirectoryList(string $path): array {
        return Storage::directories($path);
    }
}