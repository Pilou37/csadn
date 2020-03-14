<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuscribeMail extends Mailable
{
    use Queueable, SerializesModels;

    private $data_mail = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->data_mail = [
            'adherent' => $user->prenom.' '.$user->nom,
            'email' => $user->email,
            'password' => $user->password,
            'url' => route('login')
        ];
        $this->subject('Votre pré-inscription au CSADN');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.suscribe',$this->data_mail);
    }
}
