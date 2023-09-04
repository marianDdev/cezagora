<x-guest-layout>
    <div class="bg-white">
        <div>
            <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-baseline justify-between border-b border-gray-200 pb-6 pt-24">
                    @if(url()->current() === 'https://cezagora.test/my-ingredients')
                        <h1 class="text-4xl font-bold tracking-tight text-gray-900">

                            View your entire list of ingredients.
                        </h1>
                        <a class="mb-4 font-bold tracking-tight leading-none text-indigo-500"
                           href="{{ route('ingredient.create') }}">Click here to add more ingredients</a>
                    @else
                        <h1 class="text-4xl font-bold tracking-tight text-gray-900">
                            Discover our entire list of ingredients.
                        </h1>
                        @endif
                        </h1>
                </div>

                <section aria-labelledby="products-heading" class="pb-24 pt-6">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                        <!-- Filters -->
                        @include('ingredients.forms.filters', [
                            'allIngredients' => $allIngredients,
                            'companies' => $companies,
                            'functions' => $functions
                        ])

                        <!-- Product grid -->
                        <div class="lg:col-span-3">
                            <section class="bg-white dark:bg-gray-900">
                                <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                                        @foreach($filteredIngredients as $ingredient)
                                            @include('cards.ingredients.single', ['ingredient' => $ingredient])
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>
</x-guest-layout>
