<?php

namespace App\Http\Controllers;

use App\Notifications\OrderProcessed;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function charge(string $product, $price)
    {

        //todo from ingredients page try to redirect to thsi page and pass all the necessary variables
        //todo in {{ route('charge', ['variable1' => $variable1, 'variable2' => $variable2) }}
        //todo remove variables from the url of this route
        $user = $this->authUser();

        return view('dummy.payment', [
            'user'    => $user,
            'intent'  => $user->createSetupIntent(),
            'product' => $product,
            'price'   => $price,
        ]);
    }

    public function processPayment(Request $request, string $product, $price)
    {
        $user          = $this->authUser();
        $paymentMethod = $request->input('payment_method');
        $user->createOrGetStripeCustomer();
        $user->addPaymentMethod($paymentMethod);
        try {
            $user->charge($price * 100, $paymentMethod);

            $user->notify(new OrderProcessed());
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
        }

        return redirect('home');
    }
}
