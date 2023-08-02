<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function build(): NotificationEmail
    {
        return $this->subject('Notification Email')
            ->view('emails.smoking-data')
            ->with(['content' => $this->content]);
    }
}
