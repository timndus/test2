<?php

namespace App\Repositories\Redis\Default;

use App\Settings\Default\ExampleSetting;

class ExampleRepository extends \App\Repositories\Redis\ExampleRepository implements \App\Interfaces\Repositories\Default\IExampleRepository
{
    public $table = 'example';

    public function __construct(
        public ExampleSetting $setting
    ) {}
}
