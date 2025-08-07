<?php

namespace Aneef\Nationalities\Filament;

use Filament\Forms\Components\Select;
use Aneef\Nationalities\Nationalities;

class NationalitySelect
{
    /**
     * Create a nationality select field for Filament forms.
     *
     * @param string $name The field name
     * @param array $except Nationality codes to exclude
     * @param array $options Additional options to merge
     * @return Select
     */
    public static function make(string $name = 'nationality', array $except = [], array $options = []): Select
    {
        $select = Select::make($name)
            ->options(Nationalities::get($except))
            ->searchable()
            ->preload();

        // Merge additional options
        foreach ($options as $method => $value) {
            if (method_exists($select, $method)) {
                $select = $select->{$method}($value);
            }
        }

        return $select;
    }

    /**
     * Create a required nationality select field.
     *
     * @param string $name The field name
     * @param array $except Nationality codes to exclude
     * @param array $options Additional options to merge
     * @return Select
     */
    public static function required(string $name = 'nationality', array $except = [], array $options = []): Select
    {
        return static::make($name, $except, $options)->required();
    }

    /**
     * Create a multiple nationality select field.
     *
     * @param string $name The field name
     * @param array $except Nationality codes to exclude
     * @param array $options Additional options to merge
     * @return Select
     */
    public static function multiple(string $name = 'nationalities', array $except = [], array $options = []): Select
    {
        return static::make($name, $except, $options)->multiple();
    }
}
