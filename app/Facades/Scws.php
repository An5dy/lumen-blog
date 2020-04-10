<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Scws extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'scws';
    }
}
