# 🚀 How to Use the Laravel Nationalities Package

## 📦 **Step 1: Publish to GitHub**

1. **Create a new repository on GitHub:**
   - Go to https://github.com/new
   - Repository name: `laravel-nationalities`
   - Description: "A Laravel package that provides localized nationality names"
   - Make it public
   - Don't initialize with README (you already have one)

2. **Push your code to GitHub:**
   ```bash
   git remote add origin https://github.com/3neef/laravel-nationalities.git
   git branch -M main
   git push -u origin main
   ```

## 📦 **Step 2: Publish to Packagist**

1. **Go to Packagist.org:**
   - Visit https://packagist.org/packages/submit
   - Login with GitHub
   - Submit your repository URL: `https://github.com/3neef/laravel-nationalities`

## 💻 **Step 3: Using in Laravel Projects**

### **Installation**
```bash
composer require 3neef/laravel-nationalities
```

### **Basic Usage**
```php
<?php

use Aneef\Nationalities\Nationalities;

// Get all nationalities
$all = Nationalities::get();
// Result: ['EG' => 'Egyptian', 'US' => 'American', 'SA' => 'Saudi', ...]

// Exclude specific countries
$filtered = Nationalities::get(['US', 'GB']);
// Result: All nationalities except US and GB

// Get specific nationality
$egyptian = Nationalities::getByCode('EG');
// Result: 'Egyptian' (English) or 'مصري' (Arabic)

// Check if nationality exists
$exists = Nationalities::exists('EG');
// Result: true

// Search nationalities
$results = Nationalities::search('Egypt');
// Result: ['EG' => 'Egyptian']
```

### **Laravel Blade Templates**
```blade
<select name="nationality" class="form-control">
    <option value="">Select Nationality</option>
    @foreach(Nationalities::get() as $code => $name)
        <option value="{{ $code }}">{{ $name }}</option>
    @endforeach
</select>
```

### **Laravel Filament Usage**
```php
use Filament\Forms\Components\Select;
use Aneef\Nationalities\Nationalities;

// Basic select field
Select::make('nationality')
    ->options(Nationalities::get())
    ->searchable()
    ->required()

// Using the helper class
use Aneef\Nationalities\Filament\NationalitySelect;

NationalitySelect::make('nationality')
NationalitySelect::required()
NationalitySelect::multiple('nationalities')
```

### **In Filament Resource Forms**
```php
public static function form(Form $form): Form
{
    return $form->schema([
        TextInput::make('name')->required(),
        TextInput::make('email')->email()->required(),
        
        Select::make('nationality')
            ->options(Nationalities::get())
            ->searchable()
            ->required(),
    ]);
}
```

### **In Filament Tables**
```php
public static function table(Table $table): Table
{
    return $table->columns([
        TextColumn::make('name'),
        TextColumn::make('nationality')
            ->formatStateUsing(fn (string $state): string => 
                Nationalities::getByCode($state) ?? $state
            ),
    ]);
}
```

## 🌐 **Multi-Language Support**

The package automatically uses your app's locale:

```php
// In your AppServiceProvider or middleware
App::setLocale('ar'); // Arabic
$nationalities = Nationalities::get();
// Result: ['EG' => 'مصري', 'US' => 'أمريكي', ...]

App::setLocale('en'); // English  
$nationalities = Nationalities::get();
// Result: ['EG' => 'Egyptian', 'US' => 'American', ...]
```

## 🔧 **Customization**

### **Publish Language Files**
```bash
php artisan vendor:publish --provider="Aneef\Nationalities\NationalitiesServiceProvider" --tag="lang"
```

This creates files in `resources/lang/vendor/nationalities/` that you can customize.

### **Add New Languages**
Create new translation files like:
- `resources/lang/vendor/nationalities/fr/nationalities.php` (French)
- `resources/lang/vendor/nationalities/es/nationalities.php` (Spanish)

## 🧪 **Testing Your Package**

Create a test Laravel project:
```bash
composer create-project laravel/laravel test-nationalities
cd test-nationalities
composer require 3neef/laravel-nationalities
```

## 📱 **Real-World Examples**

### **User Registration Form**
```php
// In a Livewire component or Controller
use Aneef\Nationalities\Nationalities;

public function render()
{
    return view('auth.register', [
        'nationalities' => Nationalities::get()
    ]);
}
```

### **Profile Settings**
```blade
<div class="form-group">
    <label>Nationality</label>
    <select name="nationality" class="form-select">
        @foreach(Nationalities::get() as $code => $name)
            <option value="{{ $code }}" 
                {{ auth()->user()->nationality === $code ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>
```

## 🎯 **Package Features**

✅ **Laravel 9, 10, 11 Compatible**  
✅ **Auto-discovery Support**  
✅ **Localization Ready**  
✅ **Filament Integration**  
✅ **Comprehensive Testing**  
✅ **Easy Customization**

---

**Your package is ready! 🚀 Push it to GitHub and publish to Packagist to make it available for the Laravel community!**
