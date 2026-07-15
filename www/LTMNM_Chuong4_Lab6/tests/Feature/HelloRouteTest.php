<?php

namespace Tests\Feature;

use Tests\TestCase;

class HelloRouteTest extends TestCase
{
    // Bài 11: route phải trả HTTP 200 và chứa đúng phiên bản Laravel.
    public function test_hello_route_returns_laravel_12_message(): void
    {
        $this->get('/hello')
            ->assertOk()
            ->assertSeeText('Laravel 12');
    }
}
