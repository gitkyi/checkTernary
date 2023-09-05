<?php

namespace Checkternary\CheckTernary\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Checkternary\CheckTernary\CheckTernary
 */
class CheckTernary extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Checkternary\CheckTernary\CheckTernary::class;
    }
}