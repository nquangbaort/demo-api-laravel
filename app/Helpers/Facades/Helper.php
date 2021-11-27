<?php

namespace App\Helpers\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static prefectures()
 *
 * @see \App\Helpers\AppHelpers
 *
 */
class Helper extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return 'helper';
    }
}
