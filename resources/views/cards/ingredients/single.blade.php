@php
    $ingredientName = $ingredient->ingredient->common_name ?? $ingredient->ingredient->name;
    $shortName = strlen($ingredientName) > 30 ? substr($ingredientName, 0, 30) . '...' : $ingredientName;
    $userHasCompany = Auth::check() && !is_null(Auth::user()->company);
    $authCompany = $userHasCompany ? Auth::user()->company : null;
    $authUserOwnsIngredient = $userHasCompany && $authCompany->id === $ingredient->company->id;
    $seller = $authUserOwnsIngredient ? 'You are the seller' : $ingredient->company->name;
@endphp

<div
    class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">
    <h2 class="text-gray-900 text-xl font-bold mb-2 whitespace-normal break-words">{{ $shortName }}</h2>
    <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
        <img src="{{ url('/images/homepage/ingredients.jpeg') }}">
    </div>
    <p class="text-md font-normal text-gray-500 dark:text-gray-400 mb-4"><span
            class="font-bold">Price per item:</span> {{ $ingredient->price }}</p>
    <p class="text-md font-normal text-gray-500 dark:text-gray-400 mb-4"><span
            class="font-bold">Available quantity:</span> {{ $ingredient->quantity }}</p>
    <p class="text-md font-normal text-gray-500 dark:text-gray-400 mb-4"><span class="font-bold">Seller:</span> <a
            href="{{ route('company.show', ['slug' => $ingredient->company->slug]) }}"
            class="text-indigo-500">{{ $seller }}</a>
    </p>
    <p class="text-md font-normal text-gray-500 dark:text-gray-400 mb-4"><span
            class="font-bold">Function:</span> {{ strtolower($ingredient->ingredient->function) }}</p>
    @if(!$authUserOwnsIngredient)
        @include('ingredients.forms.add_to_cart', ['ingredient' => $ingredient])
    @endif
</div>
