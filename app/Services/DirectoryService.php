<?php

namespace App\Services;

use App\Settings\Default\DirectorySetting;
use Facades\App\Interfaces\Repositories\Default\IAccountRepository as AccountRepository;
use Facades\App\Services\FileSystemService;

class DirectoryService
{
    public function create(int $account_id, ?string $name): void {
        $this->checkName($name);

        $username = AccountRepository::findOrFail($account_id)['username'];

        $path = '/opt/myprogram/' . $username . '/' . $name;
        FileSystemService::createDirectory($path);
    }

    public function getList(int $account_id): array {
        $username = AccountRepository::findOrFail($account_id)['username'];
        
        $path = '/opt/myprogram/' . $username;
        $list = FileSystemService::getDirectoryList($path);

        return $list;
    }

    private function checkName(?string $name): void {
        if(!$this->isName($name)) {
            err(DirectorySetting::HTTP_CODE_UNPROCESSABLE_ENTITY, DirectorySetting::NAME_INVALID);
        }
    }

    private function isName(?string $name): bool {
        /**
         * starts with [a-zA-Z0-9]
         * may contain [- _] but must be followed by a [a-zA-Z0-9]
         */

        $len_min = DirectorySetting::LEN_MIN;
        $len_max = DirectorySetting::LEN_MAX;

        $pattern = '/^([a-zA-Z0-9]+([- _][a-zA-Z0-9]+)*){' . $len_min . ',' . $len_max . '}$/';
        return preg_match($pattern, $name) ? true : false;
    }
}