<?php

namespace App\Http\Controllers;

use Mail;

use Cart;

use Session;

use Stripe\Charge;

use Stripe\Stripe;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index() 
    {
        if(Cart::content()->count() == 0)

        {
          Session::flash('info', 'Your cart is empty purchase some items');
          return redirect()->back();  
        }
        
        return view('checkout');
    }


    public function pay()

    {
      

        Stripe::setApiKey('sk_test_uzuL21fafZ7bnAnRHLWTeFDe00nMztbspL');
        
        $token = request()->stripeToken;


        $charge = Charge::create([
            'amount' => Cart::total() * 100,
            'currency' => 'usd',
            'description' => 'Practice selling books',
            'source' => request()->stripeToken,
        ]);


         Session::flash('success', 'Purchase successful wait for our mails.');

         Cart::destroy();

         Mail::to(request()->stripeEmail)->send(new \App\Mail\PurchaseSuccessful);

         return redirect('/');

    }
}
