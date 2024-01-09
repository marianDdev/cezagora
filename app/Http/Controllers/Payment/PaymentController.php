<?php

namespace App\Http\Controllers\Payment;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Services\Notification\NotificationServiceInterface;
use App\Services\Order\OrdersServiceInterface;
use App\Services\Stripe\Payment\PaymentServiceInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    public function chargeCustomer(
        Request                      $request,
        PaymentServiceInterface      $paymentService,
        OrdersServiceInterface       $ordersService,
        NotificationServiceInterface $notificationService
    ): View
    {
        $order = $ordersService->getPendingOrder();

        if (is_null($order)) {
            return view('payments.error', ['error' => 'There are no pending orders', 'orderId' => 0]);
        }

        try {
            $paymentMethodId = $request->input('payment_method_id');
            $paymentIntent   = $paymentService->createPaymentIntent($order, $paymentMethodId);

            if ($paymentIntent->status === PaymentIntent::STATUS_REQUIRES_ACTION) {
                return view('payments.authenticate', ['clientSecret' => $paymentIntent->client_secret]);
            }

            if ($paymentIntent->status === PaymentIntent::STATUS_SUCCEEDED) {
                $paymentService->confirmPaymentIntent($paymentIntent->id, $paymentMethodId);

                event(new OrderCreated($order));
            }

            return view('payments.success', ['order' => $order]);
        } catch (Exception $e) {
            $notificationService->notifyUsAboutPaymentErrors($order, $e->getMessage());

            return view('payments.error', ['error' => $e->getMessage(), 'orderId' => $order->id]);
        }
    }

    /**
     * @throws ApiErrorException
     */
    public function createIntent(Request $request, PaymentServiceInterface $paymentService, OrdersServiceInterface $ordersService): JsonResponse
    {
        $order = $ordersService->getPendingOrder();

        if (is_null($order)) {
            return response()->json(['error' => 'No pending order found'], 404);
        }

        $paymentMethodId = $request->input('paymentMethodId');

        if (!$paymentMethodId) {
            return response()->json(['error' => 'No payment method ID provided'], 400);
        }

        $paymentIntent = $paymentService->createPaymentIntent($order, $paymentMethodId);

        if ($paymentIntent->status === PaymentIntent::STATUS_SUCCEEDED) {
            $paymentService->confirmPaymentIntent($paymentIntent->id, $paymentMethodId);
        }

        return response()->json(['clientSecret' => $paymentIntent->client_secret]);
    }
}
