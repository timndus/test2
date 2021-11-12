<?php

namespace App\Services;

use App\Settings\FileSystemSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use ZipArchive;

class FileSystemService implements \App\Interfaces\Services\IFileSystemService
{
    public function __construct(
        private FileSystemSetting $setting
    ) {}
    
    /**
     * createDirectory
     *
     * @param  string $path Ex: /var/www/html/newdir
     * @return void
     */
    public function createDirectory(string $path): void {
        if(File::isDirectory($path)) {
            err($this->setting::HTTP_CODE_CONFLICT, $this->setting::DIRECTORY_EXISTS);
        }
	    
	    if(!File::makeDirectory($path, 0755, true)) {
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
    
    /**
     * create a zip file
     *
     * @param  array $list Ex: ['opt/myprogram/parspack/file1', 'opt/myprogram/parspack/file2']
     * 
     * parent directory of files should be the /storage/app/direcotry
     * 
     * @param  string $path Ex: /var/www/storage/app/opt/backups/parspack
     * 
     * @param  string $name Ex: myzip.zip
     * 
     * @return void
     */
    public function createZip(array $list, string $path, string $name): void {
        if(!File::isDirectory($path)) {
            $this->createDirectory($path);
        }

        $full_path = $path . '/' . $name;
        if(File::isFile($full_path)) {
            Log::info(PHP_EOL . 'Zip (' . $full_path . ') already exists');
            return;
        }
        
        $zip = new ZipArchive();
        if($zip->open($full_path, ZipArchive::CREATE) !== TRUE) {
            err($this->setting::HTTP_CODE_INTERNAL_SERVER_ERROR, $this->setting::INTERNAL_SERVER_ERROR);
        }

        foreach ($list as $name) {
            $full_path = base_path() . '/storage/app/' . $name;
            $zip->addFile($full_path);
        }

        $zip->close(); 
    }
}
