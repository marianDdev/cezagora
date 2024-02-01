@if(is_null($company))
    <div class="items-center bg-gray-200 rounded-lg shadow sm:flex">
        <a role="link" aria-disabled="true">
            <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="https://cezagora.fra1.cdn.digitaloceanspaces.com/dashboard/orders.png" />
        </a>
        <div class="p-5">
            <h3 class="text-xl font-bold tracking-tight text-gray-400">
                <a role="link" aria-disabled="true">{{ $title }}</a>
            </h3>
            <span class="text-gray-500">{{ __('messages.no_orders') }}</span>
            <span
                class="text-gray-500"></span>
        </div>
    </div>
@else
    <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
        <a href="{{ route('orders') }}">
            <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="https://cezagora.fra1.cdn.digitaloceanspaces.com/dashboard/orders.png" alt="orders" />
        </a>
        <div class="p-5">
            <h3 class="text-xl font-bold tracking-tight text-indigo-500">
                <a href="{{ route('orders') }}">{{ $title }}</a>
            </h3>
            @if ($company->orders->count() === 0)
                <span class="text-gray-500">{{ __('messages.no_orders') }}</span>
            @else
                <span
                    class="text-gray-500 dark:text-gray-400">You have {{ $countOrders }} {{__('messages.active')}} {{__('messages.orders')}}</span>
            @endif
            <span
                class="text-gray-500 dark:text-gray-400"></span>
        </div>
    </div>
@endif
