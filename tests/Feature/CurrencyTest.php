<?php

namespace Tests\Feature;

use Tests\TestCase;

class CurrencyTest extends TestCase
{
    public function test_currency_can_be_switched(): void
    {
        $response = $this->get('/currency/USD');
        $response->assertRedirect();
        $this->assertEquals('USD', session('currency'));

        $response2 = $this->get('/currency/EUR');
        $response2->assertRedirect();
        $this->assertEquals('EUR', session('currency'));

        // Invalid currency falls back/is ignored
        $this->get('/currency/XYZ');
        $this->assertEquals('EUR', session('currency'));
    }
}
