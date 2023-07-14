<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderItemRequest;
use App\Models\OrderItem;
use App\Services\Order\OrdersServiceInterface;
use App\Traits\AuthUser;
use Exception;
use Illuminate\Http\RedirectResponse;

class OrderItemController extends Controller
{
    use AuthUser;

    /**
     * @throws Exception
     */
    public function store(
        StoreOrderItemRequest $request,
        OrdersServiceInterface $ordersService
    ): RedirectResponse
    {
        $validated = $request->validated();

        $order = $ordersService->getCurrentOrder();

        $order->update(['total_price' => $validated['price'] * $validated['quantity']]);
        $data = array_merge($validated, ['order_id' => $order->id]);

        $item = OrderItem::create($data);

        if (is_null($item)) {
            throw new Exception('Order item was not created', 422);
        }

        return redirect(route('ingredients'));
    }
}
