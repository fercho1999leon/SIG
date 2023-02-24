<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUserAndPasswordUserAdmision extends Mailable
{
    use Queueable, SerializesModels;
    public $credentials;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($credentials)
    {
        //
        //dd($credentials);
        $this->credentials = $credentials;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.notifyUserAndPasswordAdmision',compact('credentials'));
    }
}
