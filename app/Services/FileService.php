<?php

namespace App\Services;

use App\Settings\Default\FileSetting;
use Facades\App\Interfaces\Repositories\Default\IAccountRepository as AccountRepository;
use Facades\App\Services\FileSystemService;

class FileService
{
    public function create(int $account_id, ?string $name): void {
        $this->checkName($name);

        $username = AccountRepository::findOrFail($account_id)['username'];

        $path = '/opt/myprogram/' . $username . '/' . $name;
        FileSystemService::createFile($path);
    }

    public function getList(int $account_id): array {
        $username = AccountRepository::findOrFail($account_id)['username'];
        
        $path = '/opt/myprogram/' . $username;
        $list = FileSystemService::getFileList($path);

        return $list;
    }

    private function checkName(?string $name): void {
        if(!$this->isName($name)) {
            err(FileSetting::HTTP_CODE_UNPROCESSABLE_ENTITY, FileSetting::NAME_INVALID);
        }
    }

    private function isName(?string $name): bool {
        /**
         * starts with [a-zA-Z0-9]
         * may contain [- _] but must be followed by a [a-zA-Z0-9]
         */

        $len_min = FileSetting::LEN_MIN;
        $len_max = FileSetting::LEN_MAX;

        $pattern = '/^([a-zA-Z0-9]+([- _][a-zA-Z0-9]+)*){' . $len_min . ',' . $len_max . '}$/';
        return preg_match($pattern, $name) ? true : false;
    }
}