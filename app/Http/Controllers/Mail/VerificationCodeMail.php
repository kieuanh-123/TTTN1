<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Mã xác thực.
     *
     * @var string
     */
    public $code;

    /**
     * Create a new message instance.
     *
     * @param  string  $code
     * @return void
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mã xác thực đăng ký - Karate TMA')
                    ->view('emails.verification-code');
    }
}
