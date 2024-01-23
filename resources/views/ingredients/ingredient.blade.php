@php
    $commonShortName = strlen($ingredient->common_name) > 30 ? substr($ingredient->common_name, 0, 30) . '...' : $ingredient->common_name;
    $inciShortName = strlen($ingredient->name) > 30 ? substr($ingredient->name, 0, 30) . '...' : $ingredient->name;
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
        <p class="text-gray-500 dark:text-gray-400 mb-2">Common name: <span class="italic text-red-400">missing</span>
        </p>
    @endif
    <p class="text-gray-500 dark:text-gray-400 mb-2">INCI name: <span
            class="font-bold text-gray-700">{{ $inciShortName }}</span></p>
    <p class="text-gray-500 dark:text-gray-400 mb-2">Price per item: {{ $ingredient->price / 100 }} </p>

    <p class="text-gray-500 dark:text-gray-400 mb-2">Availability: {{ $ingredient->availability }}</p>

    @if($ingredient->availability === \App\Services\Ingredient\IngredientServiceInterface::AVAILABLE_ON_DEMAND)
        <p class="text-gray-500 dark:text-gray-400 mb-2">Available at: {{ \Carbon\Carbon::parse($ingredient->available_at)->format('d-m-Y') }}
        </p>
    @endif

    <p class="text-gray-500 dark:text-gray-400 mb-2">Available quantity: {{ $ingredient->quantity }}</p>

    <p class="text-gray-500 dark:text-gray-400 mb-2">Function: {{ strtolower($ingredient->function) }}</p>
    @if($ingredient->availability === \App\Services\Ingredient\IngredientServiceInterface::NOT_AVAILABLE)
        <p class="text-red-500 dark:text-gray-400 mb-2">Out of stock</p>
    @endif
    @include('ingredients.forms.edit', ['ingredient' => $ingredient])
</div>
