<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_screen_can_be_rendered()
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_dashboard_display_message_if_auth_user_dont_have_application()
    {
        $response = $this->get('/dashboard');

        $response->assertSee('Faça uma nova aplicação', false);

    }
}
