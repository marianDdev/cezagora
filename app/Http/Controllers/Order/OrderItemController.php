<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Services\Order\OrdersServiceInterface;
use Illuminate\Http\RedirectResponse;

class OrderItemController extends Controller
{
    public function delete(int $id, OrdersServiceInterface $service): RedirectResponse
    {
        /** @var OrderItem $item */
        $item = OrderItem::find($id);
        $service->deleteItem($item);

        return redirect()->route('checkout.show');
    }
}
