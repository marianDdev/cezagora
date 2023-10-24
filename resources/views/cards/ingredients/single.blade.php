@php
    $ingredientName = $ingredient->common_name ?? $ingredient->name;
    $shortName = strlen($ingredientName) > 30 ? substr($ingredientName, 0, 30) . '...' : $ingredientName;
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
    class="bg-blue-50 border border-blue-200 rounded-lg p-4 md:p-4">
    <p class="text-gray-900 font-bold mb-2 whitespace-normal break-words">{{ $shortName }}</p>
    <p class="text-gray-500 dark:text-gray-400 mb-4">Price per item: {{ $ingredient->price / 100 }} </p>

    <p class="text-gray-500 dark:text-gray-400 mb-4">Availability: {{ $ingredient->availability }}</p>

    @if($ingredient->availability === \App\Services\Ingredient\IngredientServiceInterface::AVAILABLE_NOW)
        <p class="text-gray-500 dark:text-gray-400 mb-4">Available at: {{ \Carbon\Carbon::parse($ingredient->available_at)->format('d-m-Y') }}
        </p>
    @endif

    <p class="text-gray-500 dark:text-gray-400 mb-4">Available quantity: {{ $ingredient->quantity }}</p>

    <p class="text-gray-500 dark:text-gray-400 mb-4">Seller:
        <a href="{{ route('company.show', ['slug' => $ingredient->company->slug]) }}" class="text-indigo-500">
            {{ $seller }}
        </a>
    </p>

    <p class="text-gray-500 dark:text-gray-400 mb-4">Function: {{ strtolower($ingredient->function) }}</p>
    @if($authUserOwnsIngredient === false)
        @include('ingredients.forms.add_to_cart', ['ingredient' => $ingredient])
    @endif
</div>
