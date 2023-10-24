<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\AuthUser;
use Illuminate\Contracts\View\View;

class CheckoutController extends Controller
{
    use AuthUser;

    public function show(): View
    {
        $pendingOrder = $this->authUser()->company ? Order::where('customer_id', $this->authUserCompany()->id)
                                                          ->where('status', Order::STATUS_PENDING)
                                                          ->first() : null;

        return view(
            'cart.show',
            [
                'order' => $pendingOrder,
            ]
        );
    }

    public function showSuccess(): View
    {
        return view('checkout.success');
    }
}

