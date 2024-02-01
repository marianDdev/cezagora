<section class="bg-white dark:bg-gray-900">
    <div class="grid max-w-screen-xl px-4 mx-auto xl:gap-0 lg:grid-cols-12 pb-10">
        <div class="mr-auto place-self-center lg:col-span-7">
            <h1 class="text-red-400 max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                {{ __('messages.discover_raw_materials_ingredients_services_in_one_place') }}
            </h1>
            <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                <a href="{{ route('register') }}" class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    {{ ucfirst(__('messages.signup')) }} {{ __('messages.now') }}
                </a>,
                {{ __('messages.join_manufacturers_suppliers_distributors_retailers') }}
            </p>
            <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">{{ __('messages.get_access_to_service_provider') }}</p>
            <a href="{{ route('contact') }}"
               class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                {{ __('messages.get_in_touch') }}
            </a>
        </div>
        <div class="hidden lg:mt-0 lg:col-span-5 lg:flex rounded">
            <img src="https://cezagora.fra1.cdn.digitaloceanspaces.com/homepage/hero.png" alt="hero image">
        </div>
    </div>
</section>
