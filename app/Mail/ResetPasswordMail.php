<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $action_link;
    public $body;

    public function __construct($action_link, $body)
    {
        $this->action_link = $action_link;
        $this->body = $body;
    }

    public function build()
    {
        // return $this->from('noreply@example.com', 'Med * A-Eye')
        //     ->subject('Reset Password')
        //     ->view('auth.passwords.forgotpasswordmail');
        return $this->subject('Reset Password')
            ->view('emails.brevo-test')
            ->with([
                'appName' => config('app.name'),
            ]);
    }
}
