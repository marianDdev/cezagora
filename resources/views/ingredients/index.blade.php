<x-guest-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($ingredients as $ingredient)
                    @include('cards.ingredients.single', ['ingredient' => $ingredient])
                @endforeach
            </div>
        </div>
    </section>
</x-guest-layout>
