<?php

namespace Digitcode\Bwallet;

use Illuminate\Support\Facades\Facade;

/**
 * Class DigitcodeFacade
 * @package Svakode\Digitcode
 */
class Bwallet extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bwallet';
    }
}
