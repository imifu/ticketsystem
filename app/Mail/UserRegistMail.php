<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserRegistMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($params = array())
    {
        $this->params = $params;
        $this->name = $params['last_name']." ".$params["first_name"];
        $this->email = $params['email'];
        // $this->email = $params['email'];
        // $this->email = $params['email'];
        // $this->email = $params['email'];
        // $this->email = $params['email'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->params["email"])
            ->subject(config('const.USER_REGIST_MAIL_TITLE'))
            ->text('mails.user_regist')
            ->with([
                'name' => $this->name,
                'params' => $this->params
            ]);
    }
}
