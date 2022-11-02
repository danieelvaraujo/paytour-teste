<?php

namespace Tests\Feature;

use App\Models\UserApplication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserApplicationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_send_an_application()
    {
        $data = [
            'name' => 'Usuario Testador',
            'email' => 'teste@email.com',
            'telephone' => '84987654321',
            'desired_job_title' => 'Desenvolvedor backend',
            'scholarity' => 'Ensino superior completo',
            'observations' => 'Campo opcional.',
        ];

        $response = $this->post('/send-application', $data);

        $response->assertOk();
        $this->assertDatabaseHas('user_applications', [
            'email' => $data['email'],
        ]);
    }

    public function test_user_can_upload_a_curriculum()
    {
        $filename = 'usuario-tostador-cv.pdf';
        $user = UserApplication::create([
            'name' => 'Usuario Testador',
            'email' => 'teste@email.com',
            'telephone' => '84987654321',
            'desired_job_title' => 'Desenvolvedor backend',
            'scholarity' => 'Ensino superior completo',
            'observations' => 'Campo opcional.',
        ]);

        $response = $this->post('/upload-curriculum', [
            'name' => 'Usuario Tostador',
            'file' => UploadedFile::fake()->create($filename, 1024),
            'applicant_id' => $user->id
        ]);

        $response->assertOk();
        Storage::disk('curriculums')->assertExists('usuario-tostador-cv.pdf');
        $this->assertDatabaseHas('curriculums', [
            'filename' => $filename,
        ]);
    }

    public function test_user_can_send_application_with_curriculum_attached()
    {
        $filename = 'usuario-tostador-cv.pdf';
        $response = $this->post('/send-application', [
            'name' => 'Usuario Testador',
            'email' => 'teste@email.com',
            'telephone' => '84987654321',
            'desired_job_title' => 'Desenvolvedor backend',
            'scholarity' => 'Ensino superior completo',
            'observations' => 'Campo opcional.',
            'file' => UploadedFile::fake()->create($filename, 1024),
        ]);

        $response->assertOk();
        Storage::disk('curriculums')->assertExists('usuario-tostador-cv.pdf');
        $this->assertDatabaseHas('user_applications', [
            'email' => "teste@email.com",
        ]);
        $this->assertDatabaseHas('curriculums', [
            'filename' => $filename,
        ]);
    }
}