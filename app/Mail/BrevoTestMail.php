<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BrevoTestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->subject('Test Email from Laravel via Brevo')
            ->view('emails.brevo-test')
            ->with([
                'appName' => config('app.name'),
            ]);
    }
}
