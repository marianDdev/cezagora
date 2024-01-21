<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 text-center">
            <h1 class="text-3xl font-bold tracking-tight text-red-400 sm:text-4xl mb-6">
                {{ __('messages.your_ingredients_list') }}
            </h1>
        </div>
        <div class="px-4 py-8 mx-auto lg:gap-8 xl:gap-0 text-center">
            <a class="mr-4 text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
               href="{{ route('ingredient.create') }}">{{ __('messages.add_more_ingredients') }}</a>
            <a class="ml-4 text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
               href="{{ route('my.products.services') }}">Back to your products and services</a>
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
</x-app-layout>
