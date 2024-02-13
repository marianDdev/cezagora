{{--TODO refactor this piece of shit--}}
{{--@php--}}
{{--    $commonShortName = strlen($ingredient->common_name) > 30 ? substr($ingredient->common_name, 0, 30) . '...' : $ingredient->common_name;--}}
{{--    $inciShortName = strlen($ingredient->name) > 30 ? substr($ingredient->name, 0, 30) . '...' : $ingredient->name;--}}
{{--    $authUserOwnsIngredient = null;--}}
{{--    if (\Illuminate\Support\Facades\Auth::check()) {--}}
{{--        $user = \Illuminate\Support\Facades\Auth::user();--}}
{{--        $userHasCompany = !is_null($user->company);--}}
{{--        $authCompany = $userHasCompany === true ? $user->company : null;--}}
{{--        $authUserOwnsIngredient = !is_null($authCompany) && $authCompany->id === $ingredient->company->id;--}}
{{--        $seller = $authUserOwnsIngredient ? 'You are the seller' : $ingredient->company->name;--}}
{{--    } else {--}}
{{--        $seller = $ingredient->company->name;--}}
{{--    }--}}
{{--@endphp--}}

{{--<div class="{{ $ingredient->availability === \App\Services\Ingredient\IngredientServiceInterface::NOT_AVAILABLE ?  'bg-gray-100' : 'bg-red-50'}} border border-red-200 rounded-lg p-2 md:p-2">--}}
{{--    @if($ingredient->documents->count() > 0)--}}
{{--        @include('ingredients._documents_info', ['ingredient' => $ingredient])--}}
{{--    @endif--}}
{{--    @if(!is_null($commonShortName))--}}
{{--        <p class="text-gray-500 dark:text-gray-400 mb-2">Common name: <span--}}
{{--                class="font-bold text-gray-700">{{ $commonShortName }}</span></p>--}}
{{--    @else--}}
{{--        <p class="text-gray-500 dark:text-gray-400 mb-2">Common name: <span class="italic text-red-400">missing</span>--}}
{{--        </p>--}}
{{--    @endif--}}

{{--    <p class="text-gray-500 dark:text-gray-400 mb-2">--}}
{{--        INCI name: <span class="font-bold text-gray-700">{{ $inciShortName }}</span>--}}
{{--    </p>--}}

{{--    @include('ingredients._seller_rating')--}}

{{--        <p class="text-gray-500 dark:text-gray-400 mb-2">Function: <span class="font-bold text-gray-700">{{ strtolower($ingredient->function) }}</span></p>--}}

{{--    <livewire:ingredient-variant-selector :ingredientId="$ingredient->id" />--}}
{{--    <livewire:quantity-selector />--}}

{{--    @if($authUserOwnsIngredient === false)--}}
{{--        @include('cart._add_modal', ['item' => $ingredient])--}}
{{--    @endif--}}
{{--</div>--}}
<livewire:ingredient-variant-selector :ingredientId="$ingredient->id" />
