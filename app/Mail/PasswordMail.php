<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, string $password)
    {
        $this->data_mail = [
            'adherent' => $user->prenom.' '.$user->nom,
            'login' => $user->login,
            'email' => $user->email,
            'password' => $password,
            'url' => route('login')
        ];
        $this->subject('Vos données de connexion');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.password',$this->data_mail);
    }
}
