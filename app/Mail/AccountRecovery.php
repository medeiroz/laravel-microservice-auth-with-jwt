<?php

namespace App\Mail;

use App\Models\Auth\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\URL;

class AccountRecovery extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $url;


    public function __construct(User $user)
    {
        $this->user = $user;
        $this->make_url();
    }


    public function build()
    {
        return $this
            ->subject('Account Recovery')
            ->to($this->user->email)
            ->view('emails.account_recovery');
    }

    private function make_url()
    {
        $this->url = URL::temporarySignedRoute(
            'api.auth.change_password',
            now()->addMinutes(config('auth.verification.expire')),
            ['user' => $this->user->email]
        );
    }
}
