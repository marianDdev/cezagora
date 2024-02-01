@if(is_null($company) || !$user->stripe_account_enabled)
    <div class="items-center bg-gray-200 rounded-lg shadow sm:flex">
        <a role="link" aria-disabled="true">
            <img class="w-2/3  rounded-lg sm:rounded-none sm:rounded-l-lg"
                 src="https://cezagora.fra1.cdn.digitaloceanspaces.com/dashboard/products_and_services.png"
                 alt="my products and services image" />
        </a>
        <div class="p-5">
            <div class="p-5">

                <h3 class="text-xl font-bold tracking-tight text-gray-400">
                    <a role="link" aria-disabled="true">
                        {{__('messages.products_services')}}
                    </a>
                </h3>

            </div>
        </div>
    </div>
@else
    <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
        <a href="{{ route('my.products.services') }}">
            <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg"
                 src="https://cezagora.fra1.cdn.digitaloceanspaces.com/dashboard/products_and_services.png"
                 alt="my products and services image" />
        </a>
        <div class="p-5">
            <h3 class="text-xl font-bold tracking-tight text-indigo-500 dark:text-white mb-2">
                <a href="{{ route('my.products.services') }}">{{__('messages.products_services')}}</a>
            </h3>
        </div>
    </div>
@endif
