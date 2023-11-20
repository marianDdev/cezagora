<x-guest-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 text-center">
            @if(url()->current() === 'https://cezagora.test/my-ingredients')
                <h1 class="max-w-2xl mb-4 text-2xl font-extrabold tracking-tight leading-none md:text-3xl xl:text-4xl">

                    View your entire list of ingredients.
                </h1>
                <a class="mb-4 font-bold tracking-tight leading-none text-indigo-500"
                   href="{{ route('ingredient.create') }}">Click here to add more ingredients</a>
            @else
                <h1 class="max-w-2xl mb-4 text-2xl font-extrabold tracking-tight leading-none md:text-3xl xl:text-4xl dark:text-white">
                    Discover our entire list of ingredients.
                </h1>
            @endif
        </div>
    </section>

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($ingredients as $ingredient)
                    @include('cards.ingredients.single', ['ingredient' => $ingredient])
                @endforeach
            </div>
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                {{ $ingredients->links() }}
            </div>
        </div>
    </section>
</x-guest-layout>
