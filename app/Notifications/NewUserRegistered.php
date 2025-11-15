<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\User;

class NewUserRegistered extends Notification
{
    use Queueable;

    protected $newUser;

    public function __construct(User $newUser)
    {
        $this->newUser = $newUser;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Thông báo: Có người mới đăng ký')
            ->greeting('Xin chào!')
            ->line('Một người dùng mới vừa đăng ký tài khoản.')
            ->line('Tên: ' . $this->newUser->name)
            ->line('Email: ' . $this->newUser->email)
            ->line('Cảm ơn bạn đã sử dụng hệ thống.');
    }
}
