<x-guest-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
            @include('pages.home.hero')
            <div class="grid md:grid-cols-2 gap-8 mb-6">
                @include('pages.home.raw_materials')
                @include('pages.home.packaging')
                @include('pages.home.equipment')
                @include('pages.home.formulation')
                @include('pages.home.laboratory')
                @include('pages.home.compliance')
            </div>

            <a href="{{ route('products.services.categories') }}"
               class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('messages.check_products_services_suppliers') }}
                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>
    </section>
</x-guest-layout>
