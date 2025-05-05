<?php

namespace App\Mail;

use App\Models\Assessment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewAssessmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $assessment;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Assessment $assessment
     * @return void
     */
    public function __construct(Assessment $assessment)
    {
        $this->assessment = $assessment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Assessment Submitted')
                    ->view('emails.new_assessment');
    }
}
