<?php

namespace DanialPanah\Farapayamak\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Farapayamak
 *
 * @package \DanialPanah\Farapayamak\Facades
 */
class Farapayamak extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'farapayamak';
    }
}