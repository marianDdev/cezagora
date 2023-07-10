<?php

namespace Database\Factories;

use App\Models\CartItem;
use App\Models\Company;
use App\Models\CompanyCategory;
use App\Models\Ingredient;
use App\Models\PackingProduct;
use App\Models\Product;
use App\Models\ProductsCategory;
use App\Models\Service;
use App\Models\ServicesCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Factory<CartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $company = Company::whereNot('id', 1)->whereNot('company_category_id', 11)->inRandomOrder()->first();
        $type = $this->getItemType($company->companyCategory->name);
        $item = $this->getItemModelId($type);

        return [
            'company_id' => $company->id,
            'item_type' => $type,
            'item_id' => $item->id,
            'name' => $item->name,
            'price' => rand(100, 999),
            'quantity' => rand(100, 999),
        ];
    }

    private function getItemType(string $companyCategory): string
    {
        $companyItemTypeMap = [
            CompanyCategory::INGREDIENTS_SUPPLIER => 'ingredient',

            CompanyCategory::MANUFACTURER => 'cosmetics_product',
            CompanyCategory::PACKING_SUPPLIER => 'packing_product',
            CompanyCategory::WHOLESALER => 'cosmetics_product',
            CompanyCategory::RETAILER => 'cosmetics_product',

            CompanyCategory::LEGAL_CONSULTANT => 'legal_service',
            CompanyCategory::LABORATORY => 'laboratory_service',
            CompanyCategory::MARKETING_AGENCY => 'marketing_service',
            CompanyCategory::DISTRIBUTOR => 'distribution_service',
            CompanyCategory::CARRIER => 'delivery_service',
        ];

        return $companyItemTypeMap[$companyCategory];
    }

    private function getItemModelId(string $itemType): Model
    {
        $packingCategoryId = ProductsCategory::inRandomOrder()->first()->id;
        $legalCategoryId = ServicesCategory::where('name', 'legal_service')->first()->id;
        $labCategoryId = ServicesCategory::where('name', 'laboratory_service')->first()->id;
        $marketingCategoryId = ServicesCategory::where('name', 'marketing_service')->first()->id;
        $distributionCategoryId = ServicesCategory::where('name', 'distribution_service')->first()->id;
        $deliveryCategoryId = ServicesCategory::where('name', 'delivery_service')->first()->id;

        $itemTypeModelMap =  [
            'ingredient' => Ingredient::inRandomOrder()->first(),
            'cosmetics_product' => Product::inRandomOrder()->first(),
            'packing_product' => PackingProduct::where('packing_product_category_id', $packingCategoryId)->inRandomOrder()->first(),
            'legal_service' => Service::where('services_category_id', $legalCategoryId)->inRandomOrder()->first(),
            'laboratory_service' => Service::where('services_category_id', $labCategoryId)->inRandomOrder()->first(),
            'marketing_service' => Service::where('services_category_id', $distributionCategoryId)->inRandomOrder()->first(),
            'distribution_service' => Service::where('services_category_id', $marketingCategoryId)->inRandomOrder()->first(),
            'delivery_service' => Service::where('services_category_id', $deliveryCategoryId)->inRandomOrder()->first(),
        ];

        return $itemTypeModelMap[$itemType];
    }
}
