<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Stripe;
use Stripe\Webhook;

class WebhookController extends Controller
{
    public function handlePaymentIntent(Request $request)
    {
        Stripe::setApiKey(config('stripe.secret'));

        $payload = $request->getContent();
        $signatureHeader = $request->header('Stripe-Signature');
        $event = null;

        try {
            $event = Webhook::constructEvent(
                $payload, $signatureHeader, config('stripe.payment_intent_webhook_secret')
            );
        } catch(\UnexpectedValueException|SignatureVerificationException $e) {
            return view('payments.error', ['error' => $e->getMessage(), 'orderId' => $order->id]);
        }

        // Handle the checkout.session.completed event
        if ($event->type == 'payment_intent.succeeded') {
            $paymentIntent = $event->data->object; // contains a StripePaymentIntent
            // Handle the successful payment intent here
            $order = Order::find($paymentIntent->metadata->order_id);
            event(new OrderCreated($order));

            return view('payments.success', ['order' => $order]);
            // Update order status or perform post-payment actions
        }

        return response()->json(['status' => 'success']);
    }
}
