<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-2xl tracking-tight font-bold text-gray-900">{{ __('messages.add_multiple_ingredients') }}</h2>
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
            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
                @include('cards.files.upload', ['entityName' => 'ingredient'])
                @include('cards.ingredients.add_one')
            </div>
        </div>
        <div>
            <label for="other_document"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Other</label>
            <input type="text" name="other_document"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <x-input-error :messages="$errors->get('other_document')" class="mt-2" />
        </div>
    </section>
</x-app-layout>
