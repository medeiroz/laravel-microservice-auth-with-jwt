<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

class SendEmailVerification extends Notification
{
    use Queueable;


    public function __construct()
    {
        //
    }


    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        $url = $this->make_url($notifiable);

        return (new MailMessage)
            ->subject('Account Verification')
            ->view('emails.account_verification', compact('url'));
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }


    private function make_url($notifiable)
    {
        return URL::temporarySignedRoute(
            'register.verification',
            now()->addMinutes(config('auth.verification.expire')),
            ['user' => $notifiable->email]
        );
    }
}
