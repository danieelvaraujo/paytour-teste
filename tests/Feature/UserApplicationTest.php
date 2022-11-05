<?php

namespace Tests\Feature;

use App\Mail\SuccessApplication;
use App\Models\User;
use App\Models\UserApplication;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

use Tests\TestCase;

class UserApplicationTest extends TestCase
{
    use RefreshDatabase;

    public User $testUser;
    public UserApplication $testUserApplication;

    protected function setUp(): void
    {
        parent::setUp();

        $this->testUser = User::factory()->create();
        Auth::login($this->testUser);

        $this->userApplicationTest = [
            'name' => $this->testUser->name,
            'email' => $this->testUser->email,
            'telephone' => '84987654321',
            'desired_job_title' => 'Desenvolvedor backend',
            'scholarity' => 'Ensino superior completo',
            'observations' => 'Campo opcional.',
            'ip_address' => '10.0.0.1',
            'user_id' => Auth::user()->id
        ];
    }

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
        UserApplication::create($this->userApplicationTest);

        $filename = str_replace(' ', '-', strtolower(Auth::user()->name)) . '-cv.pdf';
        $mockFile = UploadedFile::fake()->create($filename, 1024);

        $response = $this->post('/upload-curriculum', [
            'file' => $mockFile
        ]);

        $response->assertOk();
        Storage::disk('curriculums')->assertExists($filename);
        $this->assertDatabaseHas('curriculums', [
            'filename' => $filename,
        ]);
    }

    public function test_saving_uploaded_curriculum_filename_with_user_name()
    {
        UserApplication::create($this->userApplicationTest);

        $filename = str_replace(' ', '-', strtolower(Auth::user()->name)) . '-cv.pdf';
        $mockFile = UploadedFile::fake()->create($filename, 1024);

        $response = $this->post('/upload-curriculum', [
            'file' => $mockFile
        ]);

        $response->assertOk();
        Storage::disk('curriculums')->assertExists($filename);
        $this->assertDatabaseHas('curriculums', [
            'filename' => $filename,
        ]);
    }

    public function test_user_cant_upload_a_curriculum_with_any_format()
    {
        // Accepted formats: doc, docx, pdf

        $filename = 'usuario-testador-cv.jpg';
        UserApplication::create($this->userApplicationTest);

        $response = $this->post('/upload-curriculum', [
            'file' => UploadedFile::fake()->create($filename, 1024),
        ]);

        $response->assertSessionHasErrors();
    }

    public function test_user_cant_upload_a_curriculum_with_size_greater_than_1mb()
    {
        // Accepted formats: doc, docx, pdf

        $filename = 'usuario-testador-cv.doc';
        UserApplication::create($this->userApplicationTest);

        $response = $this->post('/upload-curriculum', [
            'file' => UploadedFile::fake()->create($filename, 2048),
        ]);

        $response->assertSessionHasErrors();
    }

    public function test_user_can_send_application_with_curriculum_attached()
    {
        $filename = str_replace(' ', '-', strtolower(Auth::user()->name)) . '-cv.pdf';
        $mockFile = UploadedFile::fake()->create($filename, 1024);

        $application = $this->userApplicationTest;
        $application['file'] = $mockFile;

        $response = $this->post('/send-application', $application);

        $response->assertOk();
        Storage::disk('curriculums')->assertExists($filename);
        $this->assertDatabaseHas('user_applications', [
            'email' => Auth::user()->email,
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

    public function test_user_application_saves_user_id_from_applicant()
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

        $response = $this->post('/send-application', $application->toArray());

        $response->assertOk();
        $this->assertDatabaseHas('user_applications', [
            'user_id' => $application->user_id,
        ]);
    }

    public function test_sends_an_email_to_user_if_application_is_successful()
    {
        Mail::fake();
        $filename = 'usuario-testador-cv.pdf';
        $application = $this->userApplicationTest;
        $application['file'] = UploadedFile::fake()->create($filename, 1024);

        $response = $this->post('/send-application', $application);

        Mail::assertSent(SuccessApplication::class);
        Mail::assertSent(SuccessApplication::class, function ($mail) use ($application) {
            return $mail->hasTo($application['email']) &&
                   $mail->hasFrom(env('MAIL_FROM_ADDRESS'));
        });
        $response->assertOk();
    }

    public function test_email_is_showing_correct_values()
    {
        $modelApplication = UserApplication::create($this->userApplicationTest);
        $mailable = new SuccessApplication($modelApplication);

        $mailable->assertHasSubject('Sua aplicação foi recebida!');

        $mailable->assertSeeInHtml($modelApplication->name);
        $mailable->assertSeeInHtml($modelApplication->email);
        $mailable->assertSeeInHtml($modelApplication->desired_job_title);
        $mailable->assertSeeInHtml('Sumário das informações enviadas.');
    }
}
