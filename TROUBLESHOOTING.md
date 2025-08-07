# 🔧 Installation Troubleshooting Guide

## Common Installation Issues and Solutions

### Issue 1: "Could not find a matching version"
```bash
Could not find a version of package 3neef/laravel-nationalities matching your minimum-stability (stable).
```

**Solutions:**
1. **Use specific version:**
   ```bash
   composer require 3neef/laravel-nationalities:v1.0.2
   ```

2. **Allow dev versions temporarily:**
   ```bash
   composer require 3neef/laravel-nationalities:dev-master
   ```

3. **Update minimum stability in composer.json:**
   ```json
   {
       "minimum-stability": "dev",
       "prefer-stable": true
   }
   ```

### Issue 2: "Package conflicts with illuminate packages"
```bash
3neef/laravel-nationalities requires illuminate/support ^7.0|^8.0|^9.0|^10.0|^11.0 but these were not loaded
```

**Solution - Check your Laravel version:**
```bash
composer show laravel/framework
```

**If you have Laravel 6 or older:**
```bash
# Install with explicit version allowing older dependencies
composer require 3neef/laravel-nationalities --ignore-platform-reqs
```

### Issue 3: "Package not found on Packagist"

**Solutions:**
1. **Wait for Packagist indexing** (can take 5-10 minutes after publishing)

2. **Install directly from GitHub:**
   Add to your `composer.json`:
   ```json
   {
       "repositories": [
           {
               "type": "vcs",
               "url": "https://github.com/3neef/Laravel-nationalites"
           }
       ]
   }
   ```
   Then run:
   ```bash
   composer require 3neef/laravel-nationalities
   ```

3. **Use specific commit:**
   ```bash
   composer require 3neef/laravel-nationalities:dev-master#4646e60
   ```

### Issue 4: "Local Development Installation"

For local testing without Packagist:

1. **Path Repository Method:**
   ```json
   {
       "repositories": [
           {
               "type": "path",
               "url": "../Laravel-nationalites"
           }
       ]
   }
   ```

2. **Symlink Method:**
   ```bash
   composer require 3neef/laravel-nationalities @dev
   ```

### Issue 5: "Auto-discovery not working"

**Manual Service Provider Registration:**
Add to `config/app.php`:
```php
'providers' => [
    // Other providers...
    Aneef\Nationalities\NationalitiesServiceProvider::class,
],
```

### Issue 6: "Translations not loading"

**Solutions:**
1. **Publish language files:**
   ```bash
   php artisan vendor:publish --provider="Aneef\Nationalities\NationalitiesServiceProvider" --tag="lang"
   ```

2. **Clear cache:**
   ```bash
   php artisan cache:clear
   php artisan config:clear
   php artisan view:clear
   ```

3. **Check locale setting:**
   ```php
   // In AppServiceProvider or middleware
   App::setLocale('en'); // or 'ar'
   ```

## Version Compatibility Matrix

| Laravel Version | PHP Version | Package Version | Status |
|----------------|-------------|-----------------|---------|
| 7.x | 7.4+ | v1.0.2+ | ✅ Supported |
| 8.x | 7.4+ | v1.0.2+ | ✅ Supported |
| 9.x | 8.0+ | v1.0.1+ | ✅ Supported |
| 10.x | 8.1+ | v1.0.1+ | ✅ Supported |
| 11.x | 8.2+ | v1.0.1+ | ✅ Supported |

## Emergency Installation Commands

If all else fails, try these in order:

```bash
# 1. Latest stable
composer require 3neef/laravel-nationalities

# 2. Specific version
composer require 3neef/laravel-nationalities:v1.0.2

# 3. Development version
composer require 3neef/laravel-nationalities:dev-master

# 4. Force install (ignore platform requirements)
composer require 3neef/laravel-nationalities --ignore-platform-reqs

# 5. Direct from GitHub
composer config repositories.3neef-nationalities vcs https://github.com/3neef/Laravel-nationalites
composer require 3neef/laravel-nationalities:dev-master
```

## Getting Help

If you're still having issues:

1. **Check the GitHub Issues:** https://github.com/3neef/Laravel-nationalites/issues
2. **Create a new issue** with:
   - Your Laravel version (`php artisan --version`)
   - Your PHP version (`php -v`)
   - Your composer.json requirements
   - The exact error message

## Quick Test After Installation

```php
// Test in tinker: php artisan tinker
use Aneef\Nationalities\Nationalities;

$nationalities = Nationalities::get();
dd($nationalities);
```

Should return an array of nationality codes and names.
