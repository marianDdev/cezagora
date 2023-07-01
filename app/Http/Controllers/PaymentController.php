<?php

namespace App\Http\Controllers;

use App\Notifications\OrderProcessed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function charge(string $product, $price)
    {
        $user = Auth::user();

        return view('dummy.payment', [
            'user'    => $user,
            'intent'  => $user->createSetupIntent(),
            'product' => $product,
            'price'   => $price,
        ]);
    }

    public function processPayment(Request $request, string $product, $price)
    {
        $user          = Auth::user();
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
