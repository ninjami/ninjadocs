<?php

namespace Ninjami\Ninjadocs;

use \Illuminate\Support\Facades\Facade;

class NinjadocsFacade extends Facade {

    protected static function getFacadeAccessor() {
        return 'ninjadocs';
    }
}
