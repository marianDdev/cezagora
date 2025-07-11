<x-guest-layout>
    <div class="bg-white">
        <div>
            <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <h1 class="text-4xl font-bold tracking-tight text-red-400 text-center">
                        {{__('messages.discover_packaging_list')}}
                    </h1>

                @include('components.cant-find')

                <section aria-labelledby="products-heading" class="pb-24 pt-6">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                        <!-- Product grid -->
                        @if($packagings->count() > 0)
                            <div class="lg:col-span-4">
                                <section class="bg-white dark:bg-gray-900">
                                    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                                            @foreach($packagings as $packaging)
                                                @include('cards.packaging.single', ['packaging' => $packaging])
                                            @endforeach
                                        </div>
                                    </div>
                                </section>
                            </div>
                        @else
                            <h3 class="mb-10 mt-16 text-2xl font-bold leading-none text-red-400 md:text-2xl lg:text-2xl dark:text-white text-center">There are no packaging products yet.</h3>
                        @endif
                    </div>
                </section>
            </main>
        </div>
    </div>
</x-guest-layout>
