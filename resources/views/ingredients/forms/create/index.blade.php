<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h1 class="mb-4 text-2xl tracking-tight font-bold text-red-400">{{ __('messages.add_multiple_ingredients') }}</h1>
                @if(session('successful_message'))
                    <div class="alert alert-success">
                        <p class="mb-4 text-xl tracking-tight font-bold text-gray-500">{{ session('successful_message') }}</p>
                    </div>
                @endif
                @if(session('error_message'))
                    <div class="alert">
                        <p class="mb-4 text-xl tracking-tight font-bold text-gray-500">{{ session('error_message') }}</p>
                    </div>
                @endif
            </div>
            <div class="mb-4 text-red-400">
                <p>Important requirements before uploading your file!:</p>
            </div>
            <div class="mb-4 text-red-400">
                <p>{{ __('messages.ingredients_required_column_names') }}</p>
            </div>
            <div class="mb-6 text-red-400">
                <p>The prices should be set in euro cents without the currency symbol: <span
                            class="font-bold text-red-600">Eg: for 10 eur set the price to 1000</span></p>
            </div>

            <a class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
               href="{{ asset('documents/ingredients_template.xlsx') }}" download>
                Download EXCEL template and use it for import
            </a>

            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2 mt-6">
                @include('cards.files.upload', ['entityName' => 'ingredient'])
                @include('ingredients.forms.create._add_ingredient_anchor')
            </div>
        </div>
    </section>
</x-app-layout>
