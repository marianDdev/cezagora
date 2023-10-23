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
        $ordersService->createOrderItem($validated);

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
