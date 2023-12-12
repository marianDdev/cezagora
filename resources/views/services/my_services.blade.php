<x-guest-layout>
    <div class="bg-white">
        <div>
            <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-baseline justify-between border-b border-gray-200 pb-6 pt-24">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900">
                        {{__('messages.your_services')}}
                    </h1>
                </div>
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
            </main>
        </div>
    </div>
</x-guest-layout>
