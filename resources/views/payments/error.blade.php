<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center">
                @if(!is_null($orderId))
                    <h1 class="mb-4 text-2xl tracking-tight font-extrabold lg:text-2xl text-primary-600 dark:text-primary-500">Whoops! Payment failed for order with id #{{ $orderId }}</h1>
                @else
                    <h1 class="mb-4 text-2xl tracking-tight font-extrabold lg:text-2xl text-primary-600 dark:text-primary-500">Whoops! Payment failed</h1>
                @endif
                <p class="mb-4 text-3xl tracking-tight font-bold text-red-500 md:text-4xl dark:text-white">{{ $error }}</p>
            </div>
        </div>
    </section>
</x-app-layout>
