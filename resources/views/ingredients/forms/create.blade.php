<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-2xl tracking-tight font-bold text-gray-900">Add multiple ingredients from an EXCEL or CSV file or add them one by one manuallly</h2>
                @if(session('successful_message'))
                    <div class="alert alert-success">
                        <p class="mb-4 text-xl tracking-tight font-bold text-gray-500">{{ session('successful_message') }}</p>
                    </div>
                @endif
            </div>
            <div class="mb-4 text-red-400">
                <p>Important requirements before uploading your file!:</p>
            </div>
            <div class="mb-4 text-red-400">
                <p>Every row of your file must contain this exact column names: <span class="font-bold text-red-600">name | common_name | description | function | price | quantity | availability | available_at</span></p>
            </div>
            <div class="mb-6 text-red-400">
                <p>The prices should be set in euro cents without the currency symbol: <span class="font-bold text-red-600">Eg: for 10 eur set the price to 1000</span></p>
            </div>
            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
                @include('cards.ingredients.upload')
                @include('cards.ingredients.add_one')
            </div>
        </div>
    </section>
</x-app-layout>
