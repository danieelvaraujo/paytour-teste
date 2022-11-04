<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserApplication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public User $testUser;
    public UserApplication $testUserApplication;


    protected function setUp(): void
    {
        parent::setUp();

        $this->testUser = User::factory()->create();
        $this->testUserApplication = UserApplication::create([
            'name' => 'Usuario Testador',
            'email' => 'teste@email.com',
            'telephone' => '84987654321',
            'desired_job_title' => 'Desenvolvedor backend',
            'scholarity' => 'Ensino superior completo',
            'observations' => 'Campo opcional.',
            'ip_address' => '10.0.0.1',
            'user_id' => $this->testUser->id
        ]);
    }

    public function test_dashboard_screen_can_be_rendered()
    {
        $response = $this->get('/dashboard/' . $this->testUser->id);

        $response->assertStatus(200);
    }

    // public function test_dashboard_display_message_if_auth_user_dont_have_application()
    // {
    //     $response = $this->get('/dashboard/' . $this->testUser->id);

    //     $response->assertSee('Faça uma nova aplicação', false);

    // }

    public function test_dashboard_display_the_authenticated_user_application_if_exists()
    {
        $response = $this->get('/dashboard/' . $this->testUser->id);

        $response->assertSee($this->testUserApplication->name, false);
        $response->assertSee($this->testUserApplication->email, false);
        $response->assertSee($this->testUserApplication->scholarity, false);
    }
}
