<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Order\OrdersServiceInterface;
use App\Services\Stripe\Payment\PaymentServiceInterface;
use Exception;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function chargeCustomer(
        PaymentServiceInterface  $paymentService,
        OrdersServiceInterface   $ordersService,
    ): View
    {
        $order = $ordersService->getPendingOrder();

        try {
            $paymentService->createPaymentIntent($order);
        } catch (Exception $e) {
            return view(
                'payments.error',
                [
                    'error' => $e->getMessage(),
                    'orderId' => $order->id,
                ]
            );
        }

        $order->update(['status' => Order::STATUS_PAYMENT_COLLECTED]);

        return view(
            'payments.success',
            [
                'order' => $order,
            ]
        );
    }
}
