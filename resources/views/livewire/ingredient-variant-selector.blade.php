<div>
    {{--TODO refactor this piece of shit--}}
    @php
        $commonShortName = strlen($ingredient->common_name) > 30 ? substr($ingredient->common_name, 0, 30) . '...' : $ingredient->common_name;
        $inciShortName = strlen($ingredient->name) > 30 ? substr($ingredient->name, 0, 30) . '...' : $ingredient->name;
        $authUserOwnsIngredient = null;
        if (\Illuminate\Support\Facades\Auth::check()) {
            $user = \Illuminate\Support\Facades\Auth::user();
            $userHasCompany = !is_null($user->company);
            $authCompany = $userHasCompany === true ? $user->company : null;
            $authUserOwnsIngredient = !is_null($authCompany) && $authCompany->id === $ingredient->company->id;
            $seller = $authUserOwnsIngredient ? 'You are the seller' : $ingredient->company->name;
        } else {
            $seller = $ingredient->company->name;
        }
    @endphp

    <div
        class="{{ $ingredient->availability === \App\Services\Ingredient\IngredientServiceInterface::NOT_AVAILABLE ?  'bg-gray-100' : 'bg-red-50'}} border border-red-200 rounded-lg p-2 md:p-2">
        @if($ingredient->documents->count() > 0)
            @include('ingredients._documents_info', ['ingredient' => $ingredient])
        @endif
        @if(!is_null($commonShortName))
            <p class="text-gray-500 dark:text-gray-400 mb-2">Common name: <span
                    class="font-bold text-gray-700">{{ $commonShortName }}</span></p>
        @else
            <p class="text-gray-500 dark:text-gray-400 mb-2">Common name: <span
                    class="italic text-red-400">missing</span>
            </p>
        @endif

        <p class="text-gray-500 dark:text-gray-400 mb-2">
            INCI name: <span class="font-bold text-gray-700">{{ $inciShortName }}</span>
        </p>

        @include('ingredients._seller_rating')

        <p class="text-gray-500 dark:text-gray-400">
            Function: <span class="font-bold text-gray-700">{{ strtolower($ingredient->function) }}</span>
        </p>

        <div class="border-b py-2">
            <div class="pt-6" id="filter-section-2">
                <div class="space-y-4">
                    <div class="flex items-center">
                        <label>
                            <select wire:model.live="selectedVariantId"
                                    class="bg-white border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach($variants as $variant)
                                    <option class="bg-white"
                                            value="{{ $variant->id }}">{{ $variant->size }}  {{ $variant->unit }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <p class="text-gray-500 dark:text-gray-400 mb-2">
            Price: <span class="font-bold text-gray-700">${{ $selectedVariant->price / 100 }}</span>
        </p>

        @if($selectedVariantId)
            <p class="text-gray-500 dark:text-gray-400 mb-2">Availability: <span
                    class="font-bold text-gray-700">{{ __('messages.' . $selectedVariant->availability) }}</span>
            </p>

            @if($selectedVariant->availability === \App\Services\Ingredient\IngredientServiceInterface::AVAILABLE_ON_DEMAND)
                <p class="text-gray-500 dark:text-gray-400 mb-2">
                    Available at: <span
                        class="font-bold text-gray-700">{{ \Carbon\Carbon::parse($selectedVariant->available_at)->format('d-m-Y') }}</span>
                </p>
            @elseif($selectedVariant->availability === \App\Services\Ingredient\IngredientServiceInterface::NOT_AVAILABLE)
                <p class="text-red-500 dark:text-gray-400 mb-2">Out of stock</p>
            @else
                <p class="text-gray-500 dark:text-gray-400 mb-2">Available quantity: <span
                        class="font-bold text-gray-700">{{ $selectedVariant->quantity }}<span
                            class="font-bold text-gray-700"></p>
            @endif
        @endif

        @if($authUserOwnsIngredient === false)
            <form action="{{ route('ingredient.order-item.store') }}" method="post">
                @csrf
                <div class="max-w-xs mx-auto">
                    <label for="quantity-input"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose quantity:</label>
                    <div class="relative flex items-center max-w-[8rem]">
                        <button wire:click.prevent="decrement" type="button"
                                class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                            <svg class="w-2.5 h-2.5 text-gray-900 dark:text-white" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M1 1h16" />
                            </svg>
                        </button>
                        <input type="number" wire:model.lazy="quantity" name="quantity" id="quantity-input" min="1"
                               max="{{ $selectedVariant->quantity }}"
                               class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               required>
                        <button wire:click.prevent="increment" type="button"
                                class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                            <svg class="w-2.5 h-2.5 text-gray-900 dark:text-white" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 1v16M1 9h16" />
                            </svg>
                        </button>
                    </div>
                    <p id="helper-text-explanation"
                       class="mt-2 text-sm text-gray-500 dark:text-gray-400">Adjust the quantity as needed.</p>
                </div>
                <input id="customer_id" name="customer_id" value="{{ $customer->id }}" type="hidden" />
                <input id="seller_id" name="seller_id" value="{{ $ingredient->company->id }}"
                       type="hidden" />
                <input id="item_id" name="item_id" value="{{ $ingredient->id }}"
                       type="hidden" />
                <input id="price" name="price" value="{{ $selectedVariant->price }}" type="hidden" />
                <input id="name" name="name" value="{{ $ingredient->name }}" type="hidden" />
                <input id="weight" name="weight" value="{{ $selectedVariant->size }}" type="hidden" />
                <input id="unit" name="unit" value="{{ $selectedVariant->unit }}" type="hidden" />
                <button type="submit"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                    Add to cart
                </button>
            </form>
        @endif
    </div>
    <div>
    </div>
</div>
