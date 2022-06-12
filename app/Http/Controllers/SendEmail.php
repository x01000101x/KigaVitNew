<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendMail;

class SendEmail extends Controller
{
    public function index()
    {
        return view('mail_send');
    }
    public function send(Request $request)
    {

        $target = $request->email;
        $datas = ['body' => $request->body];

        $data = array(
            'title' => $request->title,
            'body' => $request->body,
            'subject' => $request->subject
        );

        $emails = array($target);

        foreach ($emails as $email) {
            $this->dispatch(new SendMail($data, $email));
        }
    }

    public function back()
    {
        return view('dashboard')->with('successMsg', 'Email Terkirim!');
    }
}
