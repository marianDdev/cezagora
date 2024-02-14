<div>
    {{--TODO refactor this piece of shit--}}
    @php
        $commonShortName = strlen($ingredient->common_name) > 30 ? substr($ingredient->common_name, 0, 30) . '...' : $ingredient->common_name;
        $inciShortName = strlen($ingredient->name) > 30 ? substr($ingredient->name, 0, 30) . '...' : $ingredient->name;
    @endphp

    <div
            class="{{ $ingredient->availability === \App\Services\Ingredient\IngredientServiceInterface::NOT_AVAILABLE ?  'bg-gray-100' : 'bg-red-50'}} border border-red-200 rounded-lg p-2 md:p-2">
        @include('ingredients._documents_info', ['ingredient' => $ingredient])
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
    </div>
    <div>
    </div>
</div>
