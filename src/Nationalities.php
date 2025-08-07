<?php

namespace Aneef\Nationalities;

class Nationalities
{
    /**
     * Get localized nationalities array with optional exclusions.
     *
     * @param array $except Array of nationality codes to exclude
     * @return array Associative array of nationality codes => names
     */
    public static function get(array $except = []): array
    {
        $locale = app()->getLocale();
        
        // Get all nationality translations for current locale
        $nationalities = trans('nationalities::nationalities', [], $locale);
        
        // If translation returns the key (not found), fall back to English
        if (is_string($nationalities) || empty($nationalities)) {
            $nationalities = trans('nationalities::nationalities', [], 'en');
        }
        
        // Remove excluded nationalities
        if (!empty($except)) {
            $nationalities = array_diff_key($nationalities, array_flip($except));
        }
        
        return $nationalities;
    }

    /**
     * Get a specific nationality name by code.
     *
     * @param string $code The nationality code
     * @param string|null $locale Optional locale override
     * @return string|null The nationality name or null if not found
     */
    public static function getByCode(string $code, ?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();
        $nationalities = static::get();
        
        return $nationalities[$code] ?? null;
    }

    /**
     * Check if a nationality code exists.
     *
     * @param string $code The nationality code to check
     * @return bool
     */
    public static function exists(string $code): bool
    {
        $nationalities = static::get();
        return array_key_exists($code, $nationalities);
    }

    /**
     * Get all available nationality codes.
     *
     * @return array
     */
    public static function getCodes(): array
    {
        return array_keys(static::get());
    }

    /**
     * Search nationalities by name (case-insensitive).
     *
     * @param string $search Search term
     * @param array $except Array of nationality codes to exclude
     * @return array
     */
    public static function search(string $search, array $except = []): array
    {
        $nationalities = static::get($except);
        $search = strtolower($search);
        
        return array_filter($nationalities, function ($name) use ($search) {
            return str_contains(strtolower($name), $search);
        });
    }
}
