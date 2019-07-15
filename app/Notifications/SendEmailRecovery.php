<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

class SendEmailRecovery extends Notification
{
    use Queueable;

    protected $url;

    public function __construct($url)
    {
        $this->url = $url;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        $url = $this->url;

        return (new MailMessage)
            ->subject('Account Recovery')
            ->view('emails.account_recovery', compact('url'));
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

}
