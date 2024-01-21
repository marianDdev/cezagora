<x-app-layout>
    <div class="bg-white">
        <section class="bg-white dark:bg-gray-900">
            <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 text-center">
                <h1 class="text-3xl font-bold tracking-tight text-red-400 sm:text-4xl mb-6">
                    {{__('messages.your_services')}}
                </h1>
            </div>
            <div class="px-4 py-8 mx-auto lg:gap-8 xl:gap-0 text-center">
                <a class="mr-4 text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                   href="{{ route('service.create') }}">{{ __('messages.add_more_services') }}
                </a>
                <a class="ml-4 text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                   href="{{ route('my.products.services') }}">Back to your products and services</a>
            </div>
        </section>
        <section aria-labelledby="products-heading" class="pb-24 pt-6">
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                <!-- Product grid -->
                @if($services->count() > 0)
                    <div class="lg:col-span-4">
                        <section class="bg-white dark:bg-gray-900">
                            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                                    @foreach($services as $service)
                                        @include('cards.services.single', ['service' => $service])
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    </div>
                @else
                    <h3 class="mb-10 mt-16 text-2xl font-bold leading-none text-red-400 md:text-2xl lg:text-2xl dark:text-white text-center">There are no services yet.</h3>
                @endif
            </div>
        </section>
    </div>
</x-app-layout>
