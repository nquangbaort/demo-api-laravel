<?php

namespace App\Helpers;

use Illuminate\Support\Traits\Macroable;

class AppHelpers
{
    use Macroable;
    
    /**
     * Get list of prefectures in Japanese
     */
    public function prefectures()
    {
        return config('prefectures');
    }
}
