<?php

namespace Tests\Feature;

use App\Services\WebScrapingServices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

# php artisan test --filter=WebScrapingTest
class WebScrapingTest extends TestCase
{
    # php artisan test --filter=WebScrapingTest::test_getWebsiteInfo
    public function test_getWebsiteInfo(): void
    {
        $web_site_info = WebScrapingServices::getWebsiteInfo('https://google.com/');

        dd($web_site_info);
    }
}
