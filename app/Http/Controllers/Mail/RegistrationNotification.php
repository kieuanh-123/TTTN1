<?php

namespace App\Mail;

use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Thông tin đăng ký.
     *
     * @var \App\Models\Registration
     */
    public $registration;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Registration  $registration
     * @return void
     */
    public function __construct(Registration $registration)
    {
        $this->registration = $registration;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Đăng ký mới: ' . $this->registration->fullname)
                    ->view('emails.registration-notification');
    }
}
