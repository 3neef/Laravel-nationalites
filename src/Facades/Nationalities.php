<?php

namespace Aneef\Nationalities\Facades;

use Illuminate\Support\Facades\Facade;
use Aneef\Nationalities\Nationalities as NationalitiesClass;

/**
 * @method static array get(array $except = [])
 * @method static string|null getByCode(string $code, ?string $locale = null)
 * @method static bool exists(string $code)
 * @method static array getCodes()
 * @method static array search(string $search, array $except = [])
 *
 * @see \Aneef\Nationalities\Nationalities
 */
class Nationalities extends Facade
{
    protected static function getFacadeAccessor()
    {
        return NationalitiesClass::class;
    }
}
