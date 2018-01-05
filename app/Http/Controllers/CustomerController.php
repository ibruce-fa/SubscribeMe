<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Stripe\Stripe;

class CustomerController extends Controller
{
    public function createCustomer(Request $request)
    {
        $stripeSecretKey = config('services.stripe.secret');

        Stripe::setApiKey($stripeSecretKey);


        // Create the Stripe Customer
        $newStripeCustomer = \Stripe\Customer::create([
            'email' => $customerEmail,
            'description' => "account for $customerEmail",
            'source'  => $request->stripeToken
        ]);

        // Then create the copy for our app
        $newSMcustomer = new Customer([
            'email' => $customerEmail,
            'stripe_customer_id' => $newStripeCustomer->id,
            'user_id' => $userId
        ]);

        $newSMcustomer->save();
    }
}
