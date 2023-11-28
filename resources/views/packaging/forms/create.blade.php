<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-2xl tracking-tight font-bold text-gray-900">{{ __('messages.add_multiple_packaging') }}</h2>
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
            <div class="mb-4 text-red-400 font-bold">
                <p>{{ __('messages.upload_requirements') }}</p>
            </div>
            <div class="mb-4 text-red-400">
                <p>{{ __('messages.required_column_names') }}</p>
            </div>
            <div class="mb-6 text-red-400">
                <p>{{ __('messages.required_price_format') }}</p>
            </div>
            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
                @include('cards.files.upload', ['route' => 'packaging.upload'])
                @include('cards.ingredients.add_one')
            </div>
        </div>
    </section>
</x-app-layout>
