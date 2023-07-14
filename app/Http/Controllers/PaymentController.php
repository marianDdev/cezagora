<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Notifications\OrderProcessed;
use App\Services\Order\OrdersServiceInterface;
use App\Services\Stripe\Customer\CustomerServiceInterface;
use App\Services\Stripe\Payment\PaymentServiceInterface;
use Exception;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    public function execute(
        PaymentServiceInterface  $paymentService,
        OrdersServiceInterface   $ordersService,
        CustomerServiceInterface $customerService
    ): RedirectResponse
    {
        try {
            $order = $ordersService->getPendingOrder();
            $paymentService->createPaymentIntent($order);
            $stripeCustomer = $customerService->create($order);
            $paymentService->executeTransfers($order, $stripeCustomer);
        } catch (Exception $e) {
            return view('payment.error', ['error' => $e->getMessage()]);
        }

        $order->customer->user->notify(new OrderProcessed());

        /** @var OrderItem $orderItem */
        foreach ($order->items as $orderItem) {
            $orderItem->seller->user->notify(new OrderProcessed());
        }

        return redirect(route('checkout.success'));
    }
}
