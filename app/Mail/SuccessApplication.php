<?php

namespace App\Mail;

use App\Models\UserApplication;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SuccessApplication extends Mailable
{
    use Queueable, SerializesModels;

    public UserApplication $userApplication;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserApplication $userApplication)
    {
        $this->userApplication = $userApplication;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Sua aplicação foi recebida!',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.success-application',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [
            // Attachment::fromStorage('app/curriculums' . $this->userApplication->curriculum()->filename)
        ];
    }
}
