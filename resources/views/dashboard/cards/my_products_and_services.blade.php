@if(is_null($company) || !$user->stripe_account_enabled)

    <div class="items-center bg-gray-200 rounded-lg shadow sm:flex">
        <a role="link" aria-disabled="true">
            <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="{{ $imagePath}}"
                 alt="my products and services image" />
            <div class="p-5">
                <div class="p-5">
                    <a role="link" aria-disabled="true">
                        <h3 class="text-xl font-bold tracking-tight text-gray-400">
                            {{__('messages.products_services')}}
                        </h3>
                    </a>
                </div>
            </div>
        </a>
    </div>
@else
    <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
        <a href="{{ route('my.products.services') }}">
            <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="{{ $imagePath}}"
                 alt="my products and services image" />
            <div class="p-5">
                <div class="p-5">
                    <a href="{{ route('my.products.services') }}">
                        <h3 class="text-xl font-bold tracking-tight text-indigo-500">
                            {{__('messages.products_services')}}
                        </h3>
                    </a>
                </div>
            </div>
        </a>
    </div>
@endif
