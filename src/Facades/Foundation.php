<?php

namespace Foundation\Facades;

use Illuminate\Support\Facades\Facade;

class Foundation extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'foundation';
    }
}