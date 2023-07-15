<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransferRequest;
use App\Models\Order;
use App\Services\Notification\NotificationServiceInterface;
use App\Services\Stripe\Customer\CustomerServiceInterface;
use App\Services\Stripe\Payment\PaymentServiceInterface;
use App\Traits\AuthUser;
use Exception;
use Illuminate\Contracts\View\View;

class TransferController extends Controller
{
    use AuthUser;

    public function getTransferPage(int $orderId): View
    {
        $order = Order::find($orderId);

        return view('transfers.create', ['order' => $order]);
    }

    public function transferToSellers(
        CreateTransferRequest $request,
        PaymentServiceInterface      $paymentService,
        CustomerServiceInterface     $customerService,
        NotificationServiceInterface $notificationService
    ) {
        $validated = $request->validated();

        $order = Order::find($validated['order_id']);
        try {
            $stripeCustomer = $customerService->create($order);
            $paymentService->executeTransfers($order, $stripeCustomer);
        } catch (Exception $e) {
            return view(
                'transfers.error',
                [
                    'error'   => $e->getMessage(),
                    'orderId' => $order->id,
                ]
            );
        }

        $notificationService->notifySellersAboutMoneyTransfers($order);
    }
}
