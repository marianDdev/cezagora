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

    <p class="text-gray-500 dark:text-gray-400 mb-2">Seller:
        <a href="{{ route('ratings.index', ['slug' => $ingredient->company->slug]) }}" class="text-indigo-500">
            {{ $seller }}

            @php
                $averageRating = round($ingredient->company->receivedRatings()->avg('rating'));
            @endphp
            @if($ingredient->company->receivedRatings()->count() > 0)
                <span class="flex items-center">
                    @for ($i = 1; $i <= 5; $i++)
                        <svg class="w-4 h-4 {{ $i <= $averageRating ? 'text-yellow-300' : 'text-gray-300' }}"
                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                    @endfor
                </span>
            @endif
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
