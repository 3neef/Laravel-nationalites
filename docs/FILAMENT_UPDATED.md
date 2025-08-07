# Laravel Filament Integration Examples

This package provides seamless integration with Laravel Filament through helper classes and components.

## Quick Usage

### Basic Select Field

```php
use Aneef\Nationalities\Filament\NationalitySelect;

// In your Filament form
NationalitySelect::make()
```

### Required Field

```php
NationalitySelect::required()
```

### Multiple Selection

```php
NationalitySelect::multiple('nationalities')
```

### With Exclusions

```php
NationalitySelect::make('nationality', ['US', 'GB'])
```

## Advanced Usage

### Custom Configuration

```php
use Aneef\Nationalities\Filament\NationalitySelect;

NationalitySelect::make('nationality')
    ->except(['US', 'GB'])  // Exclude specific codes
    ->placeholder('Select nationality')
    ->helperText('Choose your nationality')
    ->columnSpan(2)
```

### In Filament Resource Forms

```php
<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Aneef\Nationalities\Filament\NationalitySelect;

class UserResource extends Resource
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                    
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                    
                NationalitySelect::required()
                    ->columnSpan(2),
                    
                // Or using the main class directly
                Forms\Components\Select::make('secondary_nationality')
                    ->options(\Aneef\Nationalities\Nationalities::get(['US']))
                    ->searchable()
                    ->nullable(),
            ]);
    }
}
```

### In Table Columns

```php
use Filament\Tables;
use Aneef\Nationalities\Nationalities;

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('name'),
            
            Tables\Columns\TextColumn::make('nationality')
                ->formatStateUsing(fn (string $state): string => 
                    Nationalities::getByCode($state) ?? $state
                )
                ->searchable()
                ->sortable(),
        ]);
}
```

### Filters

```php
use Filament\Tables\Filters\SelectFilter;
use Aneef\Nationalities\Nationalities;

SelectFilter::make('nationality')
    ->options(Nationalities::get())
    ->searchable()
```

## Custom Components

You can also create your own Filament components:

```php
<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Select;
use Aneef\Nationalities\Nationalities;

class CustomNationalitySelect extends Select
{
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->options(Nationalities::get())
            ->searchable()
            ->preload()
            ->placeholder('Select nationality...');
    }
}
```
