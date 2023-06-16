<?php

namespace Feature\Pages\Home;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    /** @test */
    public function home_page_returns_a_successful_response(): void
    {
        $response = $this->get(route('home.home'))
            ->assertSee('Home')
            ->assertSee('Credits');

        $response->assertStatus(200);
    }
}
