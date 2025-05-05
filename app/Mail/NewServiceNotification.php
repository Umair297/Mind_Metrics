<?php

namespace App\Mail;

use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewServiceNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function build()
    {
        return $this->subject('New Service Submitted')
                    ->view('emails.new_service');
    }
}
