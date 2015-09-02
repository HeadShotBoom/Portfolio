<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Input;
use Validator;
use Illuminate\Http\Request;
use Response;
use Mail;

class MailController extends Controller
{


    public function contact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required',
            'message' => 'required',
        ]);

        $data = $request->all();

        Mail::send('emails.contact', ['data' => $data], function($message) use ($data){
            $message->to('headshotboom@live.com', 'Daniel Carroll')->subject('Someone Contacted you through your site');
        });

        Mail::send('emails.contact_reply', ['data' => $data], function($message) use ($data){
            $message->to($data['email'], $data['name'])->subject('Thank You for contacting us.');
        });

        return redirect('/Contact')->with('status', 'Your message has been sent!');
    }


    public function SendServiceRequest(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required',
            'phone' => 'required',
            'address' => 'required',
            'eventDate' => 'required',
            'rushDate' => 'required_with:rush'
        ]);

        $data = $request->all();

        Mail::send('emails.serviceRequest', ['data' => $data], function($message) use ($data){
            $message->to('headshotboom@live.com', 'Daniel Carroll')->subject('Youve Received A Service Request');
        });
        return redirect('/ServiceRequest')->with('status', 'Your message has been sent!');
    }

}
