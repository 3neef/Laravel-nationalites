<?php

// Laravel Filament examples

use Filament\Forms;
use Filament\Tables;
use Vendor\Nationalities\LocalizedNationalities;
use Vendor\Nationalities\Filament\NationalitySelect;

// Example 1: Simple form field
NationalitySelect::make()

// Example 2: Required field with custom name
NationalitySelect::required('user_nationality')

// Example 3: Multiple selection
NationalitySelect::multiple('allowed_nationalities')

// Example 4: With exclusions
NationalitySelect::make('nationality', ['US', 'CA'])

// Example 5: Custom Select component
Forms\Components\Select::make('nationality')
    ->options(LocalizedNationalities::get())
    ->searchable()
    ->required()
    ->placeholder('Choose nationality...')
    ->helperText('Select your nationality from the list')

// Example 6: Table column with nationality names
Tables\Columns\TextColumn::make('nationality')
    ->formatStateUsing(fn (string $state): string => 
        LocalizedNationalities::getByCode($state) ?? $state
    )

// Example 7: Table filter
Tables\Filters\SelectFilter::make('nationality')
    ->options(LocalizedNationalities::get())
    ->searchable()
    ->multiple()
