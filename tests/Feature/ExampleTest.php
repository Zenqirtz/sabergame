<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Test that the home page route returns a successful response.
     */
    public function test_home_page_is_accessible(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test that the device page route returns a successful response.
     */
    public function test_device_page_is_accessible(): void
    {
        $response = $this->get('/device');

        $response->assertStatus(200);
    }

    /**
     * Test that the listgame page route returns a successful response.
     */
    public function test_listgame_page_is_accessible(): void
    {
        $response = $this->get('/listgame');

        $response->assertStatus(200);
    }
}
