<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center">
                <h1 class="mb-4 text-3xl tracking-tight font-extrabold lg:text-3xl text-blue-600 dark:text-primary-500">{{ __('messages.upload_failed') }}:</h1>
                <p class="mb-4 text-2xl tracking-tight font-bold text-red-500 md:text-2xl dark:text-white">{{ $uploadError }}</p>
                <a href="{{ route($route) }}" class="inline-flex text-white bg-blue-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-900 my-4">{{ __('messages.try_again') }}</a>
            </div>
        </div>
    </section>
</x-app-layout>
