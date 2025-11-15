<?php
// app/Listeners/SendNewUserNotification.php
namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use App\Notifications\NewUserRegistered;
use Illuminate\Support\Facades\Notification;

class SendNewUserNotification
{
    public function handle(Registered $event)
    {
        // Gửi mail đến admin khi có người đăng ký
        Notification::route('mail', 'kxatxxxx@gmail.com')
            ->notify(new NewUserRegistered($event->user));
    }
}
