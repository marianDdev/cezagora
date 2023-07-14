<x-guest-layout>
    @if(is_null($order))
        <div id="info-popup" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-lg h-full md:h-auto">
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 md:p-8">
                    <div class="mb-4 text-sm font-light text-gray-500 dark:text-gray-400">
                        <p>
                            Your cart is empty.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <ul>
            @foreach($order->items as $item)
                <li>{{ $item->seller->name }}</li>
                <li>{{ $item->item_type }}</li>
                <li>{{ $item->name ?? 'vasile'}}</li>
                <li>{{ $item->price }}</li>
                <li>{{ $item->quantity }}</li>
            @endforeach
        </ul>

        <form class="text-center space-y-6" method="post" action="{{ route('payment.execute') }}">
            @csrf
            <x-primary-button class="w-full justify-center">
                Buy now for {{ $order->total_price / 100}} LEI
            </x-primary-button>

        </form>
    @endif
</x-guest-layout>
