<?php

// Example usage in a Laravel application

use Aneef\Nationalities\Nationalities;

// Basic usage - get all nationalities
$all = Nationalities::get();
// Returns: ['EG' => 'Egyptian', 'US' => 'American', 'SA' => 'Saudi', ...]

// Exclude specific countries
$filtered = Nationalities::get(['US', 'GB']);
// Returns all nationalities except US and GB

// Get a specific nationality
$nationality = Nationalities::getByCode('EG');
// Returns: 'Egyptian' (or 'مصري' if locale is 'ar')

// Check if a nationality exists
$exists = Nationalities::exists('EG');
// Returns: true

// Get all nationality codes
$codes = Nationalities::getCodes();
// Returns: ['AF', 'AL', 'DZ', ...]

// Search nationalities
$results = Nationalities::search('Egypt');
// Returns: ['EG' => 'Egyptian']
