<?php

namespace Aneef\Nationalities\Tests;

use Orchestra\Testbench\TestCase;
use Aneef\Nationalities\Nationalities;
use Aneef\Nationalities\NationalitiesServiceProvider;

class NationalitiesTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [NationalitiesServiceProvider::class];
    }

    /** @test */
    public function it_can_get_all_nationalities()
    {
        $nationalities = Nationalities::get();
        
        $this->assertIsArray($nationalities);
        $this->assertNotEmpty($nationalities);
        $this->assertArrayHasKey('US', $nationalities);
        $this->assertArrayHasKey('EG', $nationalities);
        $this->assertEquals('American', $nationalities['US']);
    }

    /** @test */
    public function it_can_exclude_nationalities()
    {
        $nationalities = Nationalities::get(['US', 'EG']);
        
        $this->assertIsArray($nationalities);
        $this->assertArrayNotHasKey('US', $nationalities);
        $this->assertArrayNotHasKey('EG', $nationalities);
    }

    /** @test */
    public function it_can_get_nationality_by_code()
    {
        $nationality = Nationalities::getByCode('US');
        
        $this->assertEquals('American', $nationality);
    }

    /** @test */
    public function it_returns_null_for_invalid_code()
    {
        $nationality = Nationalities::getByCode('INVALID');
        
        $this->assertNull($nationality);
    }

    /** @test */
    public function it_can_check_if_nationality_exists()
    {
        $this->assertTrue(Nationalities::exists('US'));
        $this->assertFalse(Nationalities::exists('INVALID'));
    }

    /** @test */
    public function it_can_get_nationality_codes()
    {
        $codes = Nationalities::getCodes();
        
        $this->assertIsArray($codes);
        $this->assertContains('US', $codes);
        $this->assertContains('EG', $codes);
    }

    /** @test */
    public function it_can_search_nationalities()
    {
        $results = Nationalities::search('American');
        
        $this->assertIsArray($results);
        $this->assertArrayHasKey('US', $results);
        $this->assertEquals('American', $results['US']);
    }
}
