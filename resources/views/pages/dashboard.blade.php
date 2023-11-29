<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">

            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">{{__('messages.user_dashboard', ['user_full_name' => $user->getFullName()])}}</h2>
                @if(is_null($company) && $user->stripe_account_enabled)
                    <p class="font-light text-orange-300 lg:mb-16 sm:text-xl">{{ __('messages.required_company_details_and_stripe_onboarding') }}</p>
                @endif
            </div>

            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
                @include('cards.dashboard.company',
                        [
                            'categories' => $categories,
                            'mccs' => $mccs,
                            'company' => $company,
                            'title' => $company->name ?? null,
                            'imagePath' => 'https://t3.ftcdn.net/jpg/05/73/16/54/240_F_573165412_X2ACbn2ZmngbcY3zDE1GCQrCAMvXM75X.jpg',
                            'email' => $company->email ?? null,
                            'phone' => $company->phone ?? null,
                            'admin' => $user->getFullName(),
                            'description' => $company->product_description ?? '',
                        ]
                    )

                @include(
                    'cards.dashboard.my_products_and_services',
                    [
                        'company' => $company,
                        'imagePath' => 'https://t4.ftcdn.net/jpg/05/66/13/05/240_F_566130504_Z8omSiCut4psfaLFkYCaNu8XiIkkDQKD.jpg',
                        ]
                    )

                @include(
                        'cards.dashboard.orders',
                        [
                            'title' => 'Orders',
                            'imagePath' => 'https://t4.ftcdn.net/jpg/05/45/84/05/240_F_545840555_MUq39bHj21yG6XTpLuzPEpR7BLguhOMF.jpg',
                             'countOrders' => $company ? $company->orders->count() : 0,
                            ]
                        )

                @include(
                        'cards.dashboard.sales',
                        [
                            'title' => 'Sales',
                            'imagePath' => 'https://t4.ftcdn.net/jpg/05/21/95/57/240_F_521955761_2fIGXQXbHiwzNribojXzmGFSnO5IyMaz.jpg',
                             'countSales' => $company ? $company->sales->count() : 0,
                            ]
                        )

                @if(!is_null($account))
                    @include('cards.dashboard.stripe_dashboard', ['imagePath' => 'https://t4.ftcdn.net/jpg/05/97/91/83/240_F_597918379_Qz6aOWjXmiyduFxbwKcjYBLHPlY8FMKO.jpg',])
                @endif
            </div>
        </div>
    </section>
</x-app-layout>
