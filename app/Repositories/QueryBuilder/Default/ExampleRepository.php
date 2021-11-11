<?php

namespace App\Repositories\QueryBuilder\Default;

use App\Settings\Default\ExampleSetting;

class ExampleRepository extends \App\Repositories\QueryBuilder\ExampleRepository implements \App\Interfaces\Repositories\Default\IExampleRepository
{
    public $table = 'example';

    public function __construct(
        public ExampleSetting $setting
    ) {}
   
}
