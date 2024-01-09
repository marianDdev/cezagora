<x-app-layout>
    <h1>Transfer money to the sellers for order #{{ $order->id }}</h1>
    <form class="text-center space-y-6" method="post" action="{{ route('transfer.create') }}">
        <input id="order_id" name="order_id" value="{{ $order->id }}" type="hidden">
        @csrf
        <x-primary-button class="w-full justify-center"> Transfer ${{ $order->total_price / 100}}
        </x-primary-button>
    </form>
</x-app-layout>
