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

    public $userApplicationTest = [
        'name' => 'Usuario Testador',
        'email' => 'teste@email.com',
        'telephone' => '84987654321',
        'desired_job_title' => 'Desenvolvedor backend',
        'scholarity' => 'Ensino superior completo',
        'observations' => 'Campo opcional.',
        'ip_address' => '10.0.0.1',
    ];

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_send_an_application()
    {
        $response = $this->post('/send-application', $this->userApplicationTest);

        $response->assertOk();
        $this->assertDatabaseHas('user_applications', [
            'email' => $this->userApplicationTest['email'],
        ]);
    }

    public function test_user_can_upload_a_curriculum()
    {
        $filename = 'usuario-testador-cv.pdf';
        $application = UserApplication::create($this->userApplicationTest);

        $response = $this->post('/upload-curriculum', [
            'name' => 'Usuario Testador',
            'file' => UploadedFile::fake()->create($filename, 1024),
            'applicant_id' => $application->id
        ]);

        $response->assertOk();
        Storage::disk('curriculums')->assertExists('usuario-testador-cv.pdf');
        $this->assertDatabaseHas('curriculums', [
            'filename' => $filename,
        ]);
    }

    public function test_user_cant_upload_a_curriculum_with_any_format()
    {
        // Accepted formats: doc, docx, pdf

        $filename = 'usuario-testador-cv.jpg';
        $application = UserApplication::create($this->userApplicationTest);

        $response = $this->post('/upload-curriculum', [
            'name' => 'Usuario Testador',
            'file' => UploadedFile::fake()->create($filename, 1024),
            'applicant_id' => $application->id
        ]);

        $response->assertSessionHasErrors();
    }

    public function test_user_cant_upload_a_curriculum_with_size_greater_than_1mb()
    {
        // Accepted formats: doc, docx, pdf

        $filename = 'usuario-testador-cv.doc';
        $application = UserApplication::create($this->userApplicationTest);

        $response = $this->post('/upload-curriculum', [
            'name' => 'Usuario Testador',
            'file' => UploadedFile::fake()->create($filename, 2048),
            'applicant_id' => $application->id
        ]);

        $response->assertSessionHasErrors();
    }

    public function test_user_can_send_application_with_curriculum_attached()
    {
        $filename = 'usuario-testador-cv.pdf';
        $application = $this->userApplicationTest;
        $application['file'] = UploadedFile::fake()->create($filename, 1024);

        $response = $this->post('/send-application', $application);

        $response->assertOk();
        Storage::disk('curriculums')->assertExists('usuario-testador-cv.pdf');
        $this->assertDatabaseHas('user_applications', [
            'email' => "teste@email.com",
        ]);
        $this->assertDatabaseHas('curriculums', [
            'filename' => $filename,
        ]);
    }

    public function test_user_application_saves_ip_from_applicant()
    {
        $this->withServerVariables(['REMOTE_ADDR' => '10.1.0.1']);
        $filename = 'usuario-testador-cv.pdf';
        $application = $this->userApplicationTest;
        $application['file'] = UploadedFile::fake()->create($filename, 1024);

        $response = $this->post('/send-application', $application);

        $response->assertOk();
        $this->assertDatabaseHas('user_applications', [
            'ip_address' => '10.1.0.1',
        ]);
    }

    public function test_sends_an_email_to_user_if_application_is_successful()
    {
        $filename = 'usuario-testador-cv.pdf';
        $application = UserApplication::create($this->userApplicationTest);
        $application['file'] = UploadedFile::fake()->create($filename, 1024);

        $mailable = new ApplicationSuccess($application);

        $response = $this->post('/send-application', $application);

        $mailable->assertFrom('jeffrey@example.com');
        $mailable->assertTo('taylor@example.com');
        $mailable->assertHasSubject('Invoice Paid');

        $mailable->assertSeeInHtml($application['email']);
        $mailable->assertSeeInHtml('Invoice Paid');
        $mailable->assertSeeInOrderInHtml(['Invoice Paid', 'Thanks']);

        $mailable->assertHasAttachmentFromStorage('/storage/app/curriculums', 'usuario-testador.pdf', ['mime' => 'application/pdf']);

        $response->assertOk();
    }
}
