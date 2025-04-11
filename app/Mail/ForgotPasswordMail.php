<?php
// app/Mail/ForgotPasswordMail.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;

    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    public function build()
    {
        return $this->subject('Password Reset Request')
                    ->view('common.forgot')
                    ->with([
                        'title' => $this->mailData['title'],
                        'reset_link' => $this->mailData['reset_link'],
                        'user' => $this->mailData['user'],
                    ]);
    }
}
