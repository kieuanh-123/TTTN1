<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TwoFactorCodeNotification extends Notification
{
    use Queueable;
    public $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function via($notifiable)
    {
        return ['mail'];  // gửi qua email
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Mã xác thực hai bước của bạn')
                    ->line("Mã xác thực của bạn là: {$this->code}")
                    ->line('Mã này sẽ hết hạn sau 10 phút.')
                    ->line('Nếu bạn không vừa thử đăng nhập, hãy bỏ qua email này.');
    }
}
