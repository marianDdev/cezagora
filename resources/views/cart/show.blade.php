<x-guest-layout>
    @if(is_null($order))
        <div id="info-popup" tabindex="-1"
             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
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
        <table class="w-4/5 text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-sm text-blue-500 uppercase bg-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Seller
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Product type
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Product name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Quantity
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                            {{ $item->seller->name }}
                        </th>
                        <td class="px-6 py-4 text-indigo-500">
                            {{ $item->item_type }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->quantity }}
                        </td>
                        <td class="px-6 py-4">
                            ${{ $item->price }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <form class="text-center space-y-6" method="post" action="{{ route('payment.charge') }}">
            @csrf
            <x-primary-button class="w-full justify-center">
                Buy now for {{ $order->total_price / 100}} LEI
            </x-primary-button>

        </form>
    @endif
</x-guest-layout>
