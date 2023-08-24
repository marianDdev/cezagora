@php
    $userHasCompany = !is_null(Auth::user()->company);
    $userHasOrders = $userHasCompany && Auth::user()->company->orders->count() > 0;
@endphp

@if(!$userHasOrders)
    <div class="items-center bg-gray-200 rounded-lg shadow sm:flex">
        <a role="link" aria-disabled="true">
            <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="{{ $imagePath}}" />
        </a>
        <div class="p-5">
            <h3 class="text-xl font-bold tracking-tight text-gray-400">
                <a role="link" aria-disabled="true">{{ $title }}</a>
            </h3>
            <span class="text-gray-500">You have no active orders yet</span>
            <span
                class="text-gray-500"></span>
        </div>
    </div>
@else
    <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
        <a href="{{ route('orders') }}">
            <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="{{ $imagePath}}" />
        </a>
        <div class="p-5">
            <h3 class="text-xl font-bold tracking-tight text-indigo-500">
                <a href="{{ route('orders') }}">{{ $title }}</a>
            </h3>
            <span class="text-gray-500 dark:text-gray-400">You have {{ $countOrders }} active orders</span>
            <span
                class="text-gray-500 dark:text-gray-400"></span>
        </div>
    </div>
@endif
