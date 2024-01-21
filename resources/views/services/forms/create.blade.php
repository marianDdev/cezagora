<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h1 class="mb-4 text-2xl tracking-tight font-bold text-red-400">{{ __('messages.add_multiple_services') }}</h1>
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
            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
                @include('cards.files.upload', ['entityName' => 'service'])
                @include('cards.services.add_manually', ['company' => $company])
            </div>
        </div>
    </section>
</x-app-layout>
