<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Services\Notification\NotificationServiceInterface;
use App\Services\Order\OrdersServiceInterface;
use App\Services\Stripe\Payment\PaymentServiceInterface;
use Exception;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function chargeCustomer(
        PaymentServiceInterface  $paymentService,
        OrdersServiceInterface   $ordersService,
        NotificationServiceInterface $notificationService,
    ): View
    {
        $order = $ordersService->getPendingOrder();

        if (is_null($order)) {
            return view(
                'payments.error',
                [
                    'error' => 'There are no pending orders',
                    'orderId' => 0,
                ]
            );
        }

        try {
            $paymentService->createPaymentIntent($order);
        } catch (Exception $e) {
            $error = $e->getMessage();
            $notificationService->notifyUsAboutPaymentErrors($order, $error);

            return view(
                'payments.error',
                [
                    'error' => $e->getMessage(),
                    'orderId' => $order->id,
                ]
            );
        }

        event(new OrderCreated($order));

        return view(
            'payments.success',
            [
                'order' => $order,
            ]
        );
    }
}
