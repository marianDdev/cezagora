<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-red-400 dark:text-white">{{__('messages.user_dashboard', ['user_full_name' => $user->getFullName()])}}</h2>
                @if(is_null($company) || $user->stripe_account_enabled)
                    <p class="font-light text-orange-300 lg:mb-16 sm:text-xl">{{ __('messages.required_company_details_and_stripe_onboarding') }}</p>
                @endif
            </div>

            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
                @include('dashboard.cards.company', ['company' => $company])

                @if($hasBuyerRole)
                    @include('dashboard.cards.orders',['title' => 'Orders','countOrders' => $company ? $company->orders->count() : 0])
                @endif

                @if($hasSellerRole)
                    @include('dashboard.cards.my_products_and_services',['company' => $company])
                    @include('dashboard.cards.sales',['title' => 'Sales','countSales' => $company ? $company->sales->count() : 0])
                    @include('dashboard.cards.qualifications',['title' => 'Qualifications','qualificationsCount' => $company ? $company->qualifications->count() : 0])
                    @if(!is_null($account))
                        @include('dashboard.cards.stripe_dashboard', ['imagePath' => 'https://t4.ftcdn.net/jpg/05/97/91/83/240_F_597918379_Qz6aOWjXmiyduFxbwKcjYBLHPlY8FMKO.jpg',])
                    @endif
                @endif
            </div>
        </div>
    </section>
</x-app-layout>
