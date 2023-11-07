@php
    $notCompleted = is_null(Auth::user()->company) && Auth::user()->stripe_account_enabled == false;
@endphp

@if($notCompleted)
    <div class="items-center bg-gray-200 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
        <a role="link" aria-disabled="true">
            <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="{{ $imagePath}}" />
        </a>
        <div class="p-5">
            <a role="link" aria-disabled="true">
                <h3 class="text-xl font-bold tracking-tight text-gray-400">
                    Ingredients
                </h3>
            </a>
            <span
                class="text-gray-500 dark:text-gray-400">Please complete your company details and payment onboarding before adding ingredients</span>
        </div>
    </div>
@else

    <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
        <a href="{{ route('my-ingredients') }}">
            <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="{{ $imagePath}}" />
        </a>
        <div class="p-5">
            @if($count === 0)
                <h3 class="text-xl font-bold tracking-tight text-gray-500">
                    Ingredients
                </h3>
                <a href="{{ route('ingredient.create') }}" class="text-indigo-500">Click here to add your first ingredients</a>
            @else
                <a href="{{ route('my-ingredients') }}">
                    <h3 class="text-xl font-bold tracking-tight text-indigo-500">
                        Ingredients
                    </h3>
                </a>
                <span class="text-gray-500 dark:text-gray-400">You have {{ $count }} ingredients</span>
            @endif
        </div>
    </div>
@endif
