<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">

            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">{{ __('messages.products_services') }}</h2>
                @if(is_null($user->company) && $user->stripe_account_enabled)
                    <p class="font-light text-orange-300 lg:mb-16 sm:text-xl">{{ __('messages.required_company_details_and_stripe_onboarding') }}</p>
                @endif
            </div>

            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
                @include(
                    'dashboard.products_and_services._ingredients',
                    [
                        'count' => $ingredientsCount,
                        ]
                    )
                @include(
                    'dashboard.products_and_services._packaging',
                    [
                        'imagePath' => 'https://t4.ftcdn.net/jpg/05/68/81/15/240_F_568811549_cddvPdfy3L8AFGNYsJmS45UwuWs2PNJr.jpg',
                        'count' => $packagingCount,
                        ]
                    )

                @include(
                    'dashboard.products_and_services._products',
                    [
                        'imagePath' => 'https://t4.ftcdn.net/jpg/02/83/46/39/240_F_283463951_Hdt61pKqT09VoIZEbEsi90LnLe9q0Qo8.jpg',
                        'count' => $productsCount,
                        ]
                    )

                @include(
                   'dashboard.products_and_services._services',
                   [
                       'imagePath' => 'https://t3.ftcdn.net/jpg/03/03/54/36/240_F_303543606_tnwHT6FSbrjmSo8TIhKZ3io2pkinyCWi.jpg',
                       'count' => $servicesCount,
                       ]
                   )

                @include(
                  'dashboard.products_and_services._equipment',
                  [
                      'count' => $servicesCount,
                      ]
                  )

            </div>
        </div>
    </section>
</x-app-layout>
