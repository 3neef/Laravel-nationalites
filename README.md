# Laravel Nationalities Package

A Laravel package that provides localized nationality names with support for exclusions. Compatible with Laravel, Laravel Filament, and other Laravel-based applications.

## Features

- 🌍 Localized nationality names using Laravel's translation system
- 🚫 Optional exclusion of specific nationality codes
- 🎯 Laravel Filament compatible
- 📦 Easy installation via Composer
- 🔧 Automatic service provider registration
- 🌐 Supports multiple locales (English, Arabic, and more)

## Installation

Install the package via Composer:

```bash
composer require 3neef/laravel-nationalities
```

The service provider will be automatically registered thanks to Laravel's package auto-discovery.

## Usage

### Basic Usage

```php
use Aneef\Nationalities\Nationalities;

// Get all nationalities
$all = Nationalities::get();

// Get nationalities excluding specific codes
$filtered = Nationalities::get(['US', 'EG']);
```

### Example Output

When `app()->getLocale() === 'en'`:
```php
[
    'EG' => 'Egyptian',
    'SA' => 'Saudi',
    'US' => 'American',
    'GB' => 'British',
    // ... more nationalities
]
```

When `app()->getLocale() === 'ar'`:
```php
[
    'EG' => 'مصري',
    'SA' => 'سعودي', 
    'US' => 'أمريكي',
    'GB' => 'بريطاني',
    // ... more nationalities
]
```

### Laravel Filament Usage

Perfect for Filament forms and tables:

```php
use Filament\Forms\Components\Select;
use Aneef\Nationalities\Nationalities;

Select::make('nationality')
    ->options(Nationalities::get())
    ->searchable()
    ->required()
```

### Blade Templates

```blade
<select name="nationality">
    @foreach(Nationalities::get() as $code => $name)
        <option value="{{ $code }}">{{ $name }}</option>
    @endforeach
</select>
```

## Publishing Translations

To customize the nationality translations, publish the language files:

```bash
php artisan vendor:publish --provider="Aneef\Nationalities\NationalitiesServiceProvider" --tag="lang"
```

This will publish the translation files to `resources/lang/vendor/nationalities/`.

## Supported Languages

- English (`en`)
- Arabic (`ar`)

You can add more languages by creating additional translation files.

## Requirements

- PHP ^8.1
- Laravel ^9.0|^10.0|^11.0

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
