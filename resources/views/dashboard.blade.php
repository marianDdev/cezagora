<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">

            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">{{ $user->getFullName() }}'s dashboard</h2>
                <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400">Explore the whole collection of open-source web components and elements built with the utility classes from Tailwind</p>
            </div>

            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
                @if(!is_null($account))
                    @include('cards.stripe_dashboard', ['imagePath' => 'https://picsum.photos/id/431/200',])
                @endif

                @include('cards.company',
                    [
                        'company' => $company,
                        'title' => $company->name ?? null,
                        'imagePath' => 'https://picsum.photos/id/445/200',
                        'email' => $company->email ?? null,
                        'phone' => $company->phone ?? null,
                        'admin' => $user->getFullName(),
                        'description' => 'bla bla',
                    ]
                )

                @include(
                    'cards.ingredients',
                    [
                        'title' => sprintf('%s', $productsTitle),
                        'imagePath' => 'https://picsum.photos/id/312/200',
                        'count' => $company->ingredients->count()
                        ]
                    )

                @include(
                        'components.messages_card',
                        [
                            'title' => 'Private messages',
                            'imagePath' => 'https://picsum.photos/id/403/200',
                             'count' => 0
                            ]
                        )

                @include(
                        'components.orders_card',
                        [
                            'title' => 'Orders',
                            'imagePath' => 'https://picsum.photos/id/180/200',
                             'countOrders' => $company->orders->count(),
                             'countSales' => $company->sales->count(),
                             'pendingOrder' => (bool)$company->getPendingOrder()
                            ]
                        )
            </div>
        </div>
    </section>

    {{--    <div class="py-12">--}}
    {{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">--}}
    {{--            <div>--}}
    {{--                <h3 class="font-semibold text-gray-900">Sales stats</h3>--}}

    {{--                <dl class="mt-5 grid grid-cols-2 gap-6">--}}
    {{--                    <div class="bg-white overflow shadow-sm sm:rounded-lg px-4 py-5 sm:p-6">--}}
    {{--                        <dt class="text-sm text-gray-500">--}}
    {{--                            Sales--}}
    {{--                        </dt>--}}
    {{--                        <dd class="mt-1 text-3xl font-semibold text-gray-900">--}}
    {{--                            {{ auth()->user()->sales_count }}--}}
    {{--                        </dd>--}}
    {{--                    </div>--}}
    {{--                    <div class="bg-white overflow shadow-sm sm:rounded-lg px-4 py-5 sm:p-6">--}}
    {{--                        <dt class="text-sm text-gray-500">--}}
    {{--                            Sales volume--}}
    {{--                        </dt>--}}
    {{--                        <dd class="mt-1 text-3xl font-semibold text-gray-900">--}}
    {{--                            {{ money(auth()->user()->sales_sum_price) }}--}}
    {{--                        </dd>--}}
    {{--                    </div>--}}
    {{--                </dl>--}}
    {{--            </div>--}}

    {{--            <div>--}}
    {{--                <h3 class="font-semibold text-gray-900">All sales</h3>--}}

    {{--                @if ($sales->count())--}}
    {{--                    <div class="mt-5 overflow-hidden shadow-sm sm:rounded-lg">--}}
    {{--                        <table class="min-w-full">--}}
    {{--                            <thead class="sr-only">--}}
    {{--                                <tr>--}}
    {{--                                    <th>Product</th>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <th>Customer</th>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <th>Price</th>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <th>Date</th>--}}
    {{--                                </tr>--}}
    {{--                            </thead>--}}
    {{--                            <tbody class="bg-white">--}}
    {{--                                @foreach ($sales as $sale)--}}
    {{--                                    <tr>--}}
    {{--                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">--}}
    {{--                                            <a href="{{ route('subdomain.products.show', [$sale->product->user->subdomain, $sale->product->slug]) }}"--}}
    {{--                                               class="text-indigo-500">{{ $sale->product->title }}</a>--}}
    {{--                                        </td>--}}
    {{--                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-900">--}}
    {{--                                            {{ $sale->email }}--}}
    {{--                                        </td>--}}
    {{--                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-900">--}}
    {{--                                            {{ money($sale->price) }}--}}
    {{--                                        </td>--}}
    {{--                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-900">--}}
    {{--                                            {{ $sale->paid_at->toDateTimeString() }}--}}
    {{--                                        </td>--}}
    {{--                                    </tr>--}}
    {{--                                @endforeach--}}
    {{--                            </tbody>--}}
    {{--                        </table>--}}
    {{--                    </div>--}}
    {{--                @else--}}
    {{--                    <p class="mt-5 text-gray-600 text-sm">--}}
    {{--                        No sales, yet--}}
    {{--                    </p>--}}
    {{--                @endif--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
</x-app-layout>
