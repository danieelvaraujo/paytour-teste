<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserApplicationTest extends TestCase
{
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

        $response = $this->post('projects', [
            'file' => UploadedFile::fake()->create($filename, 1024)
        ]);

        $response->assertOk();
        Storage::disk('curriculums')->assertExists('usuario-tostador-cv.doc');
        $this->assertDatabaseHas('curriculums', [
            'file' => $filename,
        ]);
    }
}
