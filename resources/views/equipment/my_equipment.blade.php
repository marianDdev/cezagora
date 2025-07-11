<x-guest-layout>
    <div class="bg-white">
        <div>
            <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-baseline justify-between border-b border-gray-200 pb-6 pt-24">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900">
                        {{__('messages.your_equipment')}}
                    </h1>
                </div>
                <div class="flex items-baseline justify-between border-b border-gray-200 pb-6 pt-24">
                    <p class="text-gray-900">
                        <a class="mb-4 font-bold tracking-tight leading-none text-indigo-500"
                           href="{{ route('equipment.create') }}">{{ __('messages.add_more_equipment') }}</a>
                    </p>
                </div>

                <section aria-labelledby="products-heading" class="pb-24 pt-6">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                        <!-- Product grid -->
                        @if($equipments->count() > 0)
                            <div class="lg:col-span-4">
                                <section class="bg-white dark:bg-gray-900">
                                    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                                            @foreach($equipments as $equipment)
                                                @include('cards.equipment.single', ['equipment' => $equipment])
                                            @endforeach
                                        </div>
                                    </div>
                                </section>
                            </div>
                        @else
                            <h3 class="mb-10 mt-16 text-2xl font-bold leading-none text-red-400 md:text-2xl lg:text-2xl dark:text-white text-center">There are no equipment products yet.</h3>
                        @endif
                    </div>
                </section>
            </main>
        </div>
    </div>
</x-guest-layout>
