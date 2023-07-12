<x-guest-layout>
<ul>
    @foreach($items as $item)
        <li>{{ $item->seller->name }}</li>
        <li>{{ $item->item_type }}</li>
        <li>{{ $item->name ?? 'vasile'}}</li>
        <li>{{ $item->price }}</li>
        <li>{{ $item->quantity }}</li>
    @endforeach
</ul>

    <form class="text-center space-y-6" method="post" action="{{ route('checkout') }}">
        @csrf
        <x-primary-button class="w-full justify-center">
            Buy now for {{ $order->total_price / 100}} LEI
        </x-primary-button>

    </form>
</x-guest-layout>
