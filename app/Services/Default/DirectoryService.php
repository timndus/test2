<?php

namespace App\Services\Default;

use App\Interfaces\Repositories\Default\IAccountRepository;
use App\Interfaces\Services\IFileSystemService;
use App\Settings\Default\DirectorySetting;

class DirectoryService implements \App\Interfaces\Services\Default\IDirectoryService
{
    public function __construct(
        private IAccountRepository $accountRepository,
        private IFileSystemService $fileSystemService,
        private DirectorySetting $setting
    ) {}

    /**
     * create
     *
     * @param  int $account_id used to generate the path of created directory
     * @param  string $name Ex: dir1
     * @return void
     */
    public function create(int $account_id, ?string $name): void {
        $this->checkName($name);

        $username = $this->accountRepository->findOrFail($account_id)['username'];

        $path = base_path() . '/storage/app/opt/myprogram/' . $username . '/' . $name;
        $this->fileSystemService->createDirectory($path);
    }

    /**
     * getList
     *
     * @param  int $account_id
     * @return array Ex: ["opt/myprogram/parspack/dir1", "opt/myprogram/parspack/dir2"]
     */
    public function getList(int $account_id): array {
        $username = $this->accountRepository->findOrFail($account_id)['username'];
        
        $path = '/opt/myprogram/' . $username;
        $list = $this->fileSystemService->getDirectoryList($path);

        return $list;
    }

    private function checkName(?string $name): void {
        if(!$this->isName($name)) {
            err($this->setting::HTTP_CODE_UNPROCESSABLE_ENTITY, $this->setting::NAME_INVALID);
        }
    }

    /**
     * is a valid syntax for directory name
     *
     * @param  string $name
     * * starts with [a-zA-Z0-9]
     * * may contain [- _] but must be followed by a [a-zA-Z0-9]
     * @return bool
     */
    private function isName(?string $name): bool {
        $len_min = $this->setting::LEN_MIN;
        $len_max = $this->setting::LEN_MAX;

        $pattern = '/^([a-zA-Z0-9]+([- _][a-zA-Z0-9]+)*){' . $len_min . ',' . $len_max . '}$/';
        return preg_match($pattern, $name) ? true : false;
    }
}