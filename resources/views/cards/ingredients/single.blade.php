@php
    $commonName = $ingredient->common_name;
    $inciName = $ingredient->name;
    $commonShortName = strlen($commonName) > 30 ? substr($commonName, 0, 30) . '...' : $commonName;
    $inciShortName = strlen($inciName) > 30 ? substr($inciName, 0, 30) . '...' : $inciName;
    $authUserOwnsIngredient = null;
    if (\Illuminate\Support\Facades\Auth::check()) {
        $user = \Illuminate\Support\Facades\Auth::user();
        $userHasCompany = !is_null($user->company);
        $authCompany = $userHasCompany === true ? $user->company : null;
        $authUserOwnsIngredient = !is_null($userHasCompany) && $authCompany->id === $ingredient->company->id;
        $seller = $authUserOwnsIngredient ? 'You are the seller' : $ingredient->company->name;
    } else {
        $seller = $ingredient->company->name;
    }
@endphp

<div
    class="{{ $ingredient->availability === \App\Services\Ingredient\IngredientServiceInterface::NOT_AVAILABLE ?  'bg-gray-100' : 'bg-blue-50'}} border border-blue-200 rounded-lg p-2 md:p-2">
    @if(!is_null($commonShortName))
        <p class="text-gray-500 dark:text-gray-400 mb-2">Common name: <span class="font-bold text-gray-700">{{ $commonShortName }}</span></p>
    @else
        <p class="text-gray-500 dark:text-gray-400 mb-2">Common name: <span class="italic text-red-400">missing</span></p>
    @endif
    <p class="text-gray-500 dark:text-gray-400 mb-2">INCI name: <span class="font-bold text-gray-700">{{ $inciShortName }}</span></p>
    <p class="text-gray-500 dark:text-gray-400 mb-2">Price per item: {{ $ingredient->price / 100 }} </p>

    <p class="text-gray-500 dark:text-gray-400 mb-2">Availability: {{ $ingredient->availability }}</p>

    @if($ingredient->availability === \App\Services\Ingredient\IngredientServiceInterface::AVAILABLE_ON_DEMAND)
        <p class="text-gray-500 dark:text-gray-400 mb-2">Available at: {{ \Carbon\Carbon::parse($ingredient->available_at)->format('d-m-Y') }}
        </p>
    @endif

    <p class="text-gray-500 dark:text-gray-400 mb-2">Available quantity: {{ $ingredient->quantity }}</p>

    <p class="text-gray-500 dark:text-gray-400 mb-2">Seller:
        <a href="{{ route('company.show', ['slug' => $ingredient->company->slug]) }}" class="text-indigo-500">
            {{ $seller }}
        </a>
    </p>

    <p class="text-gray-500 dark:text-gray-400 mb-2">Function: {{ strtolower($ingredient->function) }}</p>
    @if($authUserOwnsIngredient === false)
        @if($ingredient->availability === \App\Services\Ingredient\IngredientServiceInterface::NOT_AVAILABLE)
            <p class="text-red-500 dark:text-gray-400 mb-2">Out of stock</p>
        @else
            @include('ingredients.forms.add_to_cart', ['ingredient' => $ingredient])
        @endif
    @endif
</div>
