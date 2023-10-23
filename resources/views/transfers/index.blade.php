<x-app-layout>
    @if ($orders->count() === 0)
    <h1>There are no collected payments to be executed</h1>
    @endif
    <table>
        <tr>
            @foreach($orders as $order)
            <h1>Transfer money to the sellers for order #{{ $order->id }}</h1>
            <form class="text-center space-y-6" method="post" action="{{ route('transfer.create') }}">
                <input id="order_id" name="order_id" value="{{ $order->id }}" type="hidden">
                @csrf
                <x-primary-button class="w-full justify-center"> Transfer ${{ $order->total_price }}
                </x-primary-button>
            </form>
            @endforeach
        </tr>
    </table>
</x-app-layout>
