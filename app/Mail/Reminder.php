<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Reminder extends Mailable
{
    use Queueable, SerializesModels;

    public $link ;
    public $id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $link, $id )
    {
        $this->link = $link ;
        $this->id = $id ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('notify.toComplete');
    }
}
