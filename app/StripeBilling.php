<?php namespace Billing;

use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Error\Card;
class StripeBilling implements BillingInterface{


    public function __construct()
    {
        Stripe::setApiKey('sk_test_kaqqXyxTj7SMTZVwQsdFiXwC');
    }

    public function charge(array $data)
    {
        try {

            return Charge::create([
                'amount' => 1000,
                'currency' => 'usd',
                'description' => $data['email'],
                'card' => $data['token']
            ]);
        } catch(Card $e)
        {
            dd('Card Declined');
        }
    }
}