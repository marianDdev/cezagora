<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderItemRequest;
use App\Models\OrderItem;
use App\Services\Order\OrdersServiceInterface;
use App\Traits\AuthUser;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;

class OrderItemController extends Controller
{
    use AuthUser;

    /**
     * @throws Exception
     */
    public function store(
        StoreOrderItemRequest  $request,
        OrdersServiceInterface $ordersService,
    ): RedirectResponse
    {
        $validated = $request->validated();
        $order     = $ordersService->getCurrentOrder();
        $data      = array_merge($validated, ['order_id' => $order->id]);
        $item      = OrderItem::create($data);

        if (is_null($item)) {
            throw new Exception('Order item was not created', 422);
        }

        $item->total = $item->price * $item->quantity;
        $item->save();

        $order->total_price += $item->total;
        $order->save();

        return redirect(route('ingredients'));
    }

    /**
     * @throws Exception
     */
    public function cancel(int $id): RedirectResponse
    {
        /** @var OrderItem $item */
        $item = OrderItem::find($id);

        $item->status = 'cancelled';
        $item->save();

        return redirect()->route('orders');
    }
}
