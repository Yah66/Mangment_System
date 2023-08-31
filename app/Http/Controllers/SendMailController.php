<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SendMailController extends Controller
{
    //
    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $details = [
            'title' => $request->title,
            'body' => $request->body,
        ];


        $job = (new SendMailJob($details));
        // dd($job);
        dispatch($job);

        return back()->with('status', 'Mails sent successfully');
    }

    public function form()
    {
        return view('send_email_form');
    }


    public function testMail(Request $request)
    {
        $users = User::all();
        foreach ($users as $user) {
            $input['name'] = $user->name;
            $input['email'] = $user->email;
            $input['title']= $request->title;
            $input['body'] = $request->body;
            Mail::send('mail.test_mail', ['input' => $input], function ($message) use ($input) {
                $message->to($input['email'], $input['name'])
                    ->subject($input['title'])
                    ->from('sender@example.com', 'Sender Name'); // Add the sender information here
            });
        }
    }
}