<?php

namespace Tests\Feature;

use Tests\TestCase;

class SmokeTests extends TestCase
{
    /**
     * Load homepage
     */
    public function testHomepageLoads(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Balance');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBlockedFromDepositPageIfNotLoggedIn(): void
    {
        $response = $this->get('/deposit');

        $response->assertStatus(302);
        $response->assertSee('Redirecting');
    }
}
