<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TagihanNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $tagihans;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tagihans)
    {
        $this->tagihans = $tagihans;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pemberitahuan Tagihan Baru')
                    ->view('emails.tagihanNotification');
    }
}
