<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Carrier\CarrierServiceInterface;
use App\Services\Delivery\DeliveryServiceInterface;
use App\Services\Ingredient\IngredientServiceInterface;
use App\Traits\AuthUser;
use Illuminate\Contracts\View\View;

class CheckoutController extends Controller
{
    use AuthUser;

    public function show(DeliveryServiceInterface $deliveryService): View
    {
        /** @var Order $pendingOrder */
        $pendingOrder = $this->authUser()->company ?
            Order::where('customer_id', $this->authUserCompany()->id)
                 ->where('status', Order::STATUS_PENDING)
                 ->first() :
            null;

        $groupedItems = $pendingOrder->items
            ->groupBy('seller_id')
            ->map(function ($items) use ($deliveryService, $pendingOrder) {
                $totalWeightInGrams = $items->reduce(function ($carry, $item) {
                    $weightInGrams = in_array($item->unit, IngredientServiceInterface::VARIANT_UNITS_MACRO) ? $item->weight * 1000 : $item->weight;

                    return $carry + $weightInGrams;
                }, 0);

                $firstItem = $items->first();
                $seller    = $firstItem->seller;
                $data      = [
                    'parcel_id'    => sprintf('%d-%d-%s', $pendingOrder->id, $firstItem->id, $firstItem->item_type),
                    'total_weight' => $totalWeightInGrams,
                    'total_price'  => $items->sum('total') / 100,
                ];

                $prices = $deliveryService->getQuotes($seller, $pendingOrder->customer, $data);

                return [
                    'total_price'  => $items->sum('total') / 100,
                    'total_weight' => $totalWeightInGrams,
                    'items'        => $items,
                    'seller'       => $seller,
                    'order_prices' => $prices,
                ];
            });


        return view(
            'cart.show',
            [
                'order'        => $pendingOrder,
                'groupedItems' => $groupedItems,
            ]
        );
    }

    public function showSuccess(): View
    {
        return view('checkout.success');
    }
}

