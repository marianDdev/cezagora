<x-guest-layout>
<ul>
    @foreach($items as $item)
        <li>{{ $item->company->name }}</li>
        <li>{{ $item->type }}</li>
        <li>{{ $item->name }}</li>
        <li>{{ $item->price }}</li>
        <li>{{ $item->quantity }}</li>
    @endforeach
</ul>

    <form class="text-center space-y-6" method="post" action="{{ route('checkout') }}">
        @csrf
        <x-primary-button class="w-full justify-center">
            Buy now for {{ $total }}
        </x-primary-button>

    </form>
</x-guest-layout>
