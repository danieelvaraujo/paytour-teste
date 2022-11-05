<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserApplication;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class UpdateApplicationTest extends TestCase
{
    use RefreshDatabase;

    public User $testUser;
    public UserApplication $testApplication;

    protected function setUp(): void
    {
        parent::setUp();

        $this->testUser = User::factory()->create();
        $this->testApplication = UserApplication::create([
            'name' => 'Usuario Testador',
            'email' => 'teste@email.com',
            'telephone' => '84987654321',
            'desired_job_title' => 'Desenvolvedor backend',
            'scholarity' => 'Ensino superior completo',
            'observations' => 'Campo opcional.',
            'ip_address' => '10.0.0.1',
            'user_id' => $this->testUser->id
        ]);

        Auth::login($this->testUser);
    }

    public function test_update_application_screen_can_be_rendered()
    {
        $response = $this->get('/update-application/' . $this->testApplication->id);

        $response->assertStatus(200);
    }

    public function test_update_application_screen_shows_existing_values()
    {
        $response = $this->get('/update-application/' . $this->testApplication->id);

        $response->assertStatus(200);
        $response->assertSee($this->testApplication->name);
        $response->assertSee($this->testApplication->email);
        $response->assertSee($this->testApplication->desired_job_title);
        $response->assertSee($this->testApplication->scholarity);
    }

    public function test_user_can_update_his_application()
    {
        $dataToChange = [
            'name' => 'Usuario Atualizado',
            'desired_job_title' => 'Desenvolvedor front-end'
        ];

        $response = $this->put('/update-application/' . $this->testApplication->id, $dataToChange);
        $response->assertOk();

        $this->assertDatabaseHas('user_applications', [
            'name' => 'Usuario Atualizado',
            'desired_job_title' => 'Desenvolvedor front-end'
        ]);
    }
}
