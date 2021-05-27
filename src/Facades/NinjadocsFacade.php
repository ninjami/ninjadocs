<?php

namespace Ninjami\Ninjadocs\Facades;

use \Illuminate\Support\Facades\Facade;

class NinjadocsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ninjadocs';
    }
}
