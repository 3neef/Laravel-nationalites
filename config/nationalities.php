<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Locale Fallback
    |--------------------------------------------------------------------------
    |
    | This option controls the default locale fallback when the current
    | application locale doesn't have nationality translations available.
    |
    */
    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Cache Duration
    |--------------------------------------------------------------------------
    |
    | Duration in minutes to cache nationality translations. Set to null
    | to disable caching. This can improve performance for large applications.
    |
    */
    'cache_duration' => 60,

    /*
    |--------------------------------------------------------------------------
    | Default Exclusions
    |--------------------------------------------------------------------------
    |
    | Default nationality codes to exclude from all calls unless explicitly
    | overridden. Useful for removing deprecated or unwanted codes globally.
    |
    */
    'default_exclusions' => [
        // 'AN', // Netherlands Antilles (deprecated)
        // Add any codes you want to exclude by default
    ],
];
