<?php

namespace Tests\Feature;

use App\Models\Curriculum;
use App\Models\User;
use App\Models\UserApplication;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public User $testUser;
    public $testApplication;

    protected function setUp(): void
    {
        parent::setUp();

        $this->testUser = User::factory()->create();
        $this->testApplication = [
            'name' => $this->testUser->name,
            'email' => $this->testUser->email,
            'telephone' => '84987654321',
            'desired_job_title' => 'Desenvolvedor backend',
            'scholarity' => 'Ensino superior completo',
            'observations' => 'Campo opcional.',
            'ip_address' => '10.0.0.1',
            'user_id' => $this->testUser->id
        ];

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
        $application = UserApplication::create($this->testApplication);
        $response = $this->get('/dashboard/' . $this->testUser->id);

        $response->assertSee($application->name, false);
        $response->assertSee($application->email, false);
        $response->assertSee($application->scholarity, false);
    }

    public function test_user_sees_update_button_if_an_application_exists()
    {
        $application = UserApplication::create($this->testApplication);
        $response = $this->get('/dashboard/' . $this->testUser->id);

        $response->assertSee('Editar aplicação');
        $response->assertSee('update-application/' . $application->id);
    }

    public function simulateStorageCurriculum()
    {
        $application = UserApplication::create($this->testApplication);
        $filename = str_replace(' ', '-', strtolower(Auth::user()->name)) . '-cv.pdf';
        $mockFile = UploadedFile::fake()->create($filename, 1024);

        Storage::disk('local')->put('curriculums', $mockFile);

        Curriculum::create([
            'name' => Auth::user()->name,
            'filename' => $filename,
            'applicant_id' => $application->id
        ]);
    }

    public function test_user_sees_his_uploaded_curriculum_in_dashboard()
    {
        $this->simulateStorageCurriculum();

        $filename = str_replace(' ', '-', strtolower(Auth::user()->name)) . '-cv.pdf';
        $response = $this->get('/dashboard/' . $this->testUser->id);

        $response->assertSee($filename, false);
    }
}
