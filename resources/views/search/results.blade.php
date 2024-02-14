<x-guest-layout>
    @if(!empty($companies))
        <h3 class="mb-10 mt-16 text-3xl font-extrabold leading-none tracking-tight text-blue-500 md:text-3xl lg:text-3xl text-center">Companies</h3>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex justify-center items-center">
            @include(
                'companies.index_table',['companies' => $companies]
                )
        </div>
    @else
        <h3 class="mb-10 mt-16 text-2xl font-bold leading-none tracking-tight text-red-400 md:text-2xl lg:text-2xl dark:text-white text-center">No matching companies under keyword "{{ $keyword }}".</h3>
    @endif

    @if(!empty($ingredients))
        <section class="bg-white dark:bg-gray-900">
            <h3 class="mb-10 mt-16 text-3xl font-extrabold leading-none tracking-tight text-blue-500 md:text-3xl lg:text-3xl text-center">Ingredients</h3>
        </section>
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($ingredients as $ingredient)
                        @include('ingredients.single', ['ingredient' => $ingredient])
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <h3 class="mb-10 mt-16 text-2xl font-bold leading-none tracking-tight text-red-400 md:text-2xl lg:text-2xl dark:text-white text-center">No matching ingredients under keyword "{{ $keyword }}"</h3>
    @endif

    @if(empty($companies) || empty($ingredients))
        @include('pages._contact-form')
    @endif
</x-guest-layout>
