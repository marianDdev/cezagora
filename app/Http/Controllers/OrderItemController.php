<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderItemRequest;
use App\Models\OrderItem;
use App\Services\Order\OrdersServiceInterface;
use App\Traits\AuthUser;
use Illuminate\Http\RedirectResponse;

class OrderItemController extends Controller
{
    use AuthUser;

    public function store(
        StoreOrderItemRequest $request,
        OrdersServiceInterface $ordersService
    ): RedirectResponse
    {
        $validated = $request->validated();
        $order = $ordersService->getCurrentOrder($validated);
        $order->update(['total_price' => $validated['price'] * $validated['quantity']]);
        $data = array_merge($validated, ['order_id' => $order->id]);

        OrderItem::create($data);

        return redirect(route('ingredients'));
    }
}
