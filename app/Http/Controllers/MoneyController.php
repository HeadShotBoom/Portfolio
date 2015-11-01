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


class MoneyController extends Controller
{


    public function makeForm(){
        return view('billing');
    }

    public function chargeCustomer(Request $request){
        $token = $_POST['stripeToken'];
        Stripe::setApiKey('sk_test_kaqqXyxTj7SMTZVwQsdFiXwC');

        try{
            Charge::create(array(
                'amount' => 1000,
                'currency' => 'usd',
                'source' => $token,
                'description' => 'Example Charge',
                'metadata' => array('order_id' => '12345')
            ));
        } catch(Card $e){
            $error1 = $e->getMessage();
            return view('billing', compact('error1'));
        }
    }

}
