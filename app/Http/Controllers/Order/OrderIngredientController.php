<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIngredientOrderItemRequest;
use App\Models\Ingredient;
use App\Models\OrderItem;
use App\Services\Carrier\CarrierServiceInterface;
use App\Services\Order\OrdersServiceInterface;
use App\Traits\AuthUser;
use Exception;
use Illuminate\Http\RedirectResponse;

class OrderIngredientController extends Controller
{
    use AuthUser;

    /**
     * @throws Exception
     */
    public function store(
        StoreIngredientOrderItemRequest $request,
        OrdersServiceInterface          $ordersService,
        CarrierServiceInterface $carrierService
    ): RedirectResponse
    {
        $validated = $request->validated();

        if ($validated['quantity'] > 0) {
            $ordersService->createOrderItem($validated, $carrierService);
        }

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
