<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatusKandidatUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $nama;
    public $status;
    public $tanggal;
    public $catatan;

    public function __construct($nama, $status, $tanggal, $catatan)
    {
        $this->nama = $nama;
        $this->status = $status;
        $this->tanggal = $tanggal;
        $this->catatan = $catatan;
    }

    public function build()
    {
        return $this->subject('Pemberitahuan Perubahan Status Kandidat')
                    ->view('emails.status_kandidat');
    }
}
