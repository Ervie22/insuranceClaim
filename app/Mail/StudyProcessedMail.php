<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudyProcessedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $firstName;
    public $studyName;

    public function __construct($firstName, $studyName)
    {
        $this->firstName = $firstName;
        $this->studyName = $studyName;
    }

    public function build()
    {
        return $this->subject("{$this->studyName} has been successfully processed")
            ->view('emails.study_processed')
            ->with([
                'firstName' => $this->firstName,
                'studyName' => $this->studyName,
            ]);
    }
}
