<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NilaiNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $nama_santri;
    public $waliSantri;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nama_santri, $waliSantri)
    {
        $this->nama_santri = $nama_santri;
        $this->waliSantri = $waliSantri;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pemberitahuan Nilai Terbaru')
                    ->view('emails.nilaiNotification');
    }
}
