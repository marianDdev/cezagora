<x-app-layout>
    <div class="bg-white">
        <div>
            <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-baseline justify-between border-b border-gray-200 pb-6 pt-24">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900">
                        Your orders
                    </h1>
                </div>

                <section aria-labelledby="products-heading" class="pb-24 pt-6">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                        <!-- Product grid -->
                        <div class="lg:col-span-3">
                            <section class="bg-white dark:bg-gray-900">
                                <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                                        @foreach($orders as $order)
                                            @foreach($order->items as $item)
                                                <div
                                                    class="bg-blue-50 border border-blue-200 rounded-lg p-2 md:p-2">
                                                    <p class="text-gray-500 dark:text-gray-400 mb-2">Order id: <span
                                                            class="font-bold text-gray-700"> #{{ $order->id }}</span>
                                                    </p>
                                                    <p class="text-gray-500 dark:text-gray-400 mb-2">Seller: <span
                                                            class="font-bold text-gray-700">{{ $item->seller->name }}</span>
                                                    </p>

                                                    <p class="text-gray-500 dark:text-gray-400 mb-2">Item type: {{ $item->item_type }} </p>

                                                    <p class="text-gray-500 dark:text-gray-400 mb-2">Item name: {{ $item->name }}</p>

                                                    <p class="text-gray-500 dark:text-gray-400 mb-2">Item quantity: {{ $item->quantity }}
                                                    </p>

                                                    <p class="text-gray-500 dark:text-gray-400 mb-2">Price: ${{ $item->price }}</p>
                                                    <p class="text-gray-500 dark:text-gray-400 mb-2">Status: {{ $item->status }}</p>

                                                    <div class="mb-6">
                                                        <form
                                                            action="{{ route('order-item.cancel', ['id' => $item->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <x-primary-button>
                                                                {{ __('Cancel') }}
                                                            </x-primary-button>
                                                        </form>
                                                    </div>
                                                    @if(!$company->givenRatings()->where('reviewee_id', $item->seller->id)->exists())
                                                        @include('components.rating', ['seller' => $item->seller])
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>
</x-app-layout>
