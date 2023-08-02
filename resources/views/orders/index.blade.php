<x-app-layout>
    <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Your orders</h2>
    </div>
    @foreach($orders as $order)
        <table class="w-4/5 text-sm text-left text-gray-500 dark:text-gray-400 mb-10">
            <thead class="text-sm text-blue-500 uppercase bg-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-3" style="color: indigo">
                        Order #{{ $order->id }}
                    </th>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Seller
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Item type
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Item name
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
    @endforeach
</x-app-layout>
