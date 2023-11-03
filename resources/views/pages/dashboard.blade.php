<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">

            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">{{ $user->getFullName() }}'s dashboard</h2>
                @if(is_null(\Illuminate\Support\Facades\Auth::user()->company) && \Illuminate\Support\Facades\Auth::user()->stripe_account_enabled == false)
                    <p class="font-light text-orange-300 lg:mb-16 sm:text-xl">Please keep in mind that certain actions can be performed only after adding company details and the payment onboarding is completed.</p>
                @endif
            </div>

            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
                @include('cards.dashboard.company',
                        [
                            'categories' => $categories,
                            'mccs' => $mccs,
                            'company' => $company,
                            'title' => $company->name ?? null,
                            'imagePath' => 'https://picsum.photos/id/445/200',
                            'email' => $company->email ?? null,
                            'phone' => $company->phone ?? null,
                            'admin' => $user->getFullName(),
                            'description' => 'bla bla',
                        ]
                    )

                @if(!is_null($account))
                    @include('cards.dashboard.stripe_dashboard', ['imagePath' => 'https://picsum.photos/id/431/200',])
                @endif

                @include(
                    'cards.dashboard.my_products_and_services',
                    [
                        'title' => sprintf('%s', $productsTitle),
                        'imagePath' => 'https://picsum.photos/id/312/200',
                        'count' => $company ? $company->ingredients->count() : 0
                        ]
                    )

                @include(
                        'cards.dashboard.orders',
                        [
                            'title' => 'Orders',
                            'imagePath' => 'https://picsum.photos/id/180/200',
                             'countOrders' => $company ? $company->orders->count() : 0,
                            ]
                        )

                @include(
                        'cards.dashboard.sales',
                        [
                            'title' => 'Sales',
                            'imagePath' => 'https://picsum.photos/id/180/200',
                             'countSales' => $company ? $company->sales->count() : 0,
                            ]
                        )
            </div>
        </div>
    </section>
</x-app-layout>
