<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmAccount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $token;
    private $email;
    private $fname;

    public function __construct($fname ,$email, $token)
    {
        $this->token = $token;
        $this->email = $email;
        $this->fname = $fname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $confirmAccountConfirm = sprintf("%s/user/activateUserAccount?email=%s&token=%s",env('APP_URL'),$this->email,$this->token);
        return $this->view('email.confirm-account')
            ->with('name', $this->fname)
            ->with('url', $confirmAccountConfirm);
    }
}
