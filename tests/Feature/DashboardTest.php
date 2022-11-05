<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserApplication;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public User $testUser;
    public UserApplication $testUserApplication;


    protected function setUp(): void
    {
        parent::setUp();

        $this->testUser = User::factory()->create();
        Auth::login($this->testUser);
    }

    public function test_dashboard_screen_can_be_rendered()
    {
        $response = $this->get('/dashboard/' . $this->testUser->id);

        $response->assertStatus(200);
    }

    public function test_dashboard_display_message_if_auth_user_dont_have_application()
    {
        $response = $this->get('/dashboard/' . $this->testUser->id);

        $response->assertSee('Faça uma nova aplicação', false);

    }

    public function test_dashboard_display_the_authenticated_user_application_if_exists()
    {
        $testUserApplication = UserApplication::create([
            'name' => 'Usuario Testador',
            'email' => 'teste@email.com',
            'telephone' => '84987654321',
            'desired_job_title' => 'Desenvolvedor backend',
            'scholarity' => 'Ensino superior completo',
            'observations' => 'Campo opcional.',
            'ip_address' => '10.0.0.1',
            'user_id' => $this->testUser->id
        ]);

        $response = $this->get('/dashboard/' . $this->testUser->id);

        $response->assertSee($testUserApplication->name, false);
        $response->assertSee($testUserApplication->email, false);
        $response->assertSee($testUserApplication->scholarity, false);
    }

    public function test_user_sees_update_button_if_an_application_exists()
    {
        $application = UserApplication::create([
            'name' => 'Usuario Testador',
            'email' => 'teste@email.com',
            'telephone' => '84987654321',
            'desired_job_title' => 'Desenvolvedor backend',
            'scholarity' => 'Ensino superior completo',
            'observations' => 'Campo opcional.',
            'ip_address' => '10.0.0.1',
            'user_id' => $this->testUser->id
        ]);

        $response = $this->get('/dashboard/' . $this->testUser->id);
        $response->assertSee('Editar aplicação');
        $response->assertSee('update-application/' . $application->id);
    }
}
