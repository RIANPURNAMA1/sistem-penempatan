<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class RegistrasiConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Konfirmasi Registrasi Sistem Kandidat')
            ->view('emails.registrasi_confirmation')
            ->with([
                'verificationUrl' => route('verify.email', $this->user->verification_token)
            ]);
    }
}
