<?php

namespace App\Mail;

use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data, $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $email)
    {
        $this->data = $data;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        dd($this->email);
        Mail::send(
            'mail.confirm',
            [
                'title' => $this->data['title'],
                'body' => $this->data['body'],
            ],
            function ($message) {
                $message->from('no-reply@testmail.com', 'Test Notification');
                $message->to($this->email)->subject($this->data['subject']);
            }
        );

        // return $this->subject($subjects)
        //     ->view('mail_send');

    }
}
