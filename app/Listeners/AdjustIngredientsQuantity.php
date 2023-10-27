<?php

namespace App\Listeners;

use App\Models\Ingredient;
use App\Models\OrderItem;
use App\Services\Ingredient\IngredientServiceInterface;

class AdjustIngredientsQuantity
{
    public function __construct(public IngredientServiceInterface $ingredientService)
    {
    }

    public function handle(object $event): void
    {
        $order = $event->order;

        /** @var OrderItem $item */
        foreach ($order->items as $item) {
            /** @var Ingredient $ingredient */
            $ingredient           = Ingredient::find($item->item_id);
            $availableStock = $ingredient->quantity - $item->quantity;
            $ingredient->update(['quantity' => $availableStock]);

            if ($availableStock === 0) {
                $ingredient->update(['availability' => IngredientServiceInterface::NOT_AVAILABLE]);

            }
        }
    }
}
