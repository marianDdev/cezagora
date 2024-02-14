<x-guest-layout>
    <div class="bg-white">
        <div>
            <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-red-400 sm:text-4xl mb-2 text-center">
                    {{ __('messages.discover_ingredients_list') }}
                </h1>

                @include('components.cant-find')

                <section aria-labelledby="products-heading" class="pb-24 pt-6">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                        <!-- Filters -->
                        @include('ingredients.forms.filters', [
                            'allIngredients' => $allIngredients,
                            'companies' => $companies,
                            'functions' => $functions
                        ])

                        <!-- Product grid -->
                        @if($filteredIngredients->count() > 0)
                            <div class="lg:col-span-3">
                                <section class="bg-white dark:bg-gray-900">
                                    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                                            @foreach($filteredIngredients as $ingredient)
                                                @include('ingredients._ingredient', ['ingredient' => $ingredient])
                                            @endforeach
                                        </div>
                                        {{ $filteredIngredients->links() }}
                                    </div>
                                </section>
                            </div>
                        @else
                            <h3 class="mb-10 mt-16 text-2xl font-bold leading-none text-red-400 md:text-2xl lg:text-2xl dark:text-white text-center">{{ __('messages.search_no_result') }}</h3>
                        @endif
                    </div>
                </section>
            </main>
        </div>
    </div>
</x-guest-layout>
