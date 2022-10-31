<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CurriculumTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_send_curriculum_without_file()
    {
        $data = [
            'name' => 'Usuario Testador',
            'email' => 'teste@email.com',
            'telephone' => '84987654321',
            'desired_job_title' => 'Desenvolvedor backend',
            'scholarity' => 'Ensino superior completo',
            'observations' => 'Campo opcional.',
        ];

        $response = $this->post('/send-curriculum', $data);

        $response->assertOk();
        $this->assertDatabaseHas('curriculums', [
            'email' => $data['email'],
        ]);
    }

    public function test_user_curriculum_upload()
    {
        Storage::fake('curriculums');

        $data = [
            'name' => 'Usuario Testador',
            'email' => 'teste@email.com',
            'telephone' => '84987654321',
            'desired_job_title' => 'Desenvolvedor backend',
            'scholarity' => 'Ensino superior completo',
            'observations' => 'Campo opcional.',
            'file' => UploadedFile::fake()->create('usuario-tostador-cv', 1, '.doc')
        ];

        $response = $this->post('/send-curriculum', $data);

        $response->assertOk();
        Storage::disk('curriculums')->assertExists('usuario-tostador-cv.doc');
        $this->assertDatabaseHas('curriculums', [
            'email' => $data['email'],
        ]);
    }
}
