<?php

namespace App\Interfaces\Services;

interface IFileSystemService extends IService {
    public function createDirectory(string $path): void;
    public function createFile(string $path): void;
    public function getDirectoryList(string $path): array;
    public function getFileList(string $path): array;
}