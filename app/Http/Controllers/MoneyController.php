<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Input;
use Validator;
use Illuminate\Http\Request;
use Response;
use App\BillingInterface;
use Illuminate\Foundation\Application;
use Illuminate\Database\Eloquent\Model;


class MoneyController extends Controller
{


    public function makeForm(Request $request){
        return view('billing');
    }

    public function chargeCustomer(Request $request){
        $billing = new BillingInterface;
    }

}
