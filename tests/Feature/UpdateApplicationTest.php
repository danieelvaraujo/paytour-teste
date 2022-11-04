<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserApplication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateApplicationTest extends TestCase
{
    use RefreshDatabase;

    public User $testUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->testUser = User::factory()->create();
    }

    public function test_update_application_screen_can_be_rendered()
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

        $response = $this->get('/update-application/' . $application->id);

        $response->assertStatus(200);
    }
}
