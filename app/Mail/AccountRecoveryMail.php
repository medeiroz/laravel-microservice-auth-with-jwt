<?php

namespace App\Mail;

use App\Models\Auth\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountRecoveryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $url;


    public function __construct(User $user, string $url)
    {
        $this->user = $user;
        $this->url = $url;
    }


    public function build()
    {
        return $this
            ->subject('Account Recovery')
            ->to($this->user->email)
            ->view('emails.account_recovery');
    }
}
