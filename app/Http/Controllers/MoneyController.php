<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Input;
use Validator;
use Illuminate\Http\Request;
use Response;
use Illuminate\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Error\Card;
use Auth;
use DB;
use Mail;

class MoneyController extends Controller
{


    public function makeForm(Request $request){
        $url = explode('/', $request->url());
        $chargeId = $url[count($url) -1];
        $charges = DB::table('billing')->where('id', $chargeId)->get();
        $thisCharge = $charges[0];

        return view('billing', compact('thisCharge'));
    }

    public function chargeCustomer(Request $request){
        $url = explode('/', $request->url());
        $chargeId = $url[count($url) -1];
        $charges = DB::table('billing')->where('id', $chargeId)->get();
        $mailData = $charges[0];
        $token = $_POST['stripeToken'];
        Stripe::setApiKey('sk_test_kaqqXyxTj7SMTZVwQsdFiXwC');

        try{
            Charge::create(array(
                'amount' => $charges[0]->amount,
                'currency' => 'usd',
                'source' => $token,
                'description' => $charges[0]->description,
                'metadata' => array('Customer Name' => $charges[0]->name, 'Customer Email' => $charges[0]->email)
            ));
        } catch(Card $e){
            $error1 = $e->getMessage();
            return view('billing', compact('error1'));
        }
        Mail::send('emails.paymentNotify', ['mailData' => $mailData], function($message) use ($mailData){
            $message->to('headshotboom@live.com', 'Daniel Carroll')->subject('Payment Received');
        });
        Mail::send('emails.paymentThanks', ['mailData' => $mailData], function($message) use ($mailData){
            $message->to($mailData->email, $mailData->name)->subject('Payment Received');
        });
        $success = array(
            'billMessage' => 'Your Payment Has Been Sent'
        );
        DB::table('billing')->where('id', $chargeId)->delete();
        return view('thanks');
    }

    public function makeBill()
    {
        if(Auth::check()) {
            return view('makeBill');
        }else{
            return redirect ('/auth/login');
        }
    }

    public function sendBill()
    {
        $inputs = Input::all();
        $validator = Validator::make($inputs, [
            'email' => 'required|email',
            'amount' => 'required|numeric',
            'name' => 'required',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return redirect('/MakeBill')->withErrors($validator)->withInput();
        } else {
            DB::table('billing')->insert(['name' => $inputs['name'], 'email' => $inputs['email'], 'amount' => $inputs['amount'], 'description' => $inputs['description']]);
            $success = array(
                'billMessage' => 'Your Bill Has Been Created'
            );
            $thisId = DB::table('billing')->max('id');
            Mail::send('emails.customerBill', ['inputs' => $inputs, 'thisId' => $thisId], function($message) use ($inputs, $thisId){
                $message->to($inputs['email'], $inputs['name'])->subject('Legendary Productions Invoice');
            });
            return redirect('/MakeBill')->withErrors($success);
        }
    }

}
