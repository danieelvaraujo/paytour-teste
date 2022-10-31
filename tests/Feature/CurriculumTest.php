<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
            'nome' => 'Daniel Valente',
            'email' => "daniel@email.com",
            'telephone' => '84987418355',
            'desired_job_title' => 'Backend Developer (Laravel)',
            'scholarity' => 'Civil Engieener',
            'observations' => 'Campo opcional.',
        ];

        $response = $this->post('/send-curriculum', $data);

        $response->assertOk();
        $this->assertDatabaseHas('curriculums', [
            'email' => $data['email'],
        ]);
    }
}
