<?php

namespace App\Listeners;

use App\Models\CompanyIngredient;
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
            if ($this->itemQuantityShouldAdjust($item, $this->ingredientService)) {
                $company = $item->seller;
                /** @var CompanyIngredient $companyIngredient */
                $companyIngredient = $this->ingredientService->getCompanyIngredient($item->seller_id, $item->item_id);
                $quantity          = $companyIngredient->quantity - $item->quantity;
                $company->ingredients()->updateExistingPivot($item->item_id, ['quantity' => $quantity]);
            }
        }
    }

    private function itemQuantityShouldAdjust(OrderItem $item, IngredientServiceInterface $ingredientService): bool
    {
        $isIngredient             = $item->item_type === 'ingredient';
        $companyIngredientNotNull = !is_null($ingredientService->getCompanyIngredient($item->seller_id, $item->item_id));

        return $isIngredient && $companyIngredientNotNull;
    }
}
