<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeBusiness extends Mailable
{
    use Queueable, SerializesModels;

    private $business;
    private $messageBody;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($business, $messageBody)
    {
        $this->business     = $business;
        $this->messageBody  = $messageBody;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = getBusinessNotificationsUrl($this->business->id);

        return $this->markdown('emails.business.welcome-business')->with([
            'body'      => $this->messageBody,
            'url'       => $url
        ]);
    }
}
