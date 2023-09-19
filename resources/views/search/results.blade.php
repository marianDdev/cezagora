<x-guest-layout>
    @if(!empty($companies))
        <h3 class="mb-10 mt-16 text-3xl font-extrabold leading-none tracking-tight text-blue-500 md:text-3xl lg:text-3xl text-center">Companies</h3>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex justify-center items-center">
            @if($companies->count() > 0)
                @include(
                    'companies.index_table',['companies' => $companies]
                    )
            @else
                <h3 class="mb-10 mt-16 text-3xl font-extrabold leading-none tracking-tight text-blue-500 md:text-3xl lg:text-3xl dark:text-white text-center">Motha fucka you have zero ingredients. Move your ass and add some!</h3>
            @endif
        </div>
    @endif

    @if(!empty($ingredients))
        <section class="bg-white dark:bg-gray-900">
            <h3 class="mb-10 mt-16 text-3xl font-extrabold leading-none tracking-tight text-blue-500 md:text-3xl lg:text-3xl text-center">Ingredients</h3>
        </section>
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($ingredients as $ingredient)
                        @include('cards.ingredients.single', ['ingredient' => $ingredient])
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-guest-layout>
