<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">

            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">{{ __('messages.products_services') }}</h2>
                @if(is_null(\Illuminate\Support\Facades\Auth::user()->company) && \Illuminate\Support\Facades\Auth::user()->stripe_account_enabled == false)
                    <p class="font-light text-orange-300 lg:mb-16 sm:text-xl">Please keep in mind that certain actions can be performed only after adding company details and the payment onboarding is completed.</p>
                @endif
            </div>

            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
                @include(
                    'cards.dashboard.ingredients',
                    [
                        'imagePath' => 'https://t4.ftcdn.net/jpg/01/47/49/91/240_F_147499122_4KXxa1Z019XaEfEvPYnCTdaQ7uc1GOBB.jpg',
                        'count' => $ingredientsCount
                        ]
                    )
                @include(
                    'cards.dashboard.packaging',
                    [
                        'imagePath' => 'https://t4.ftcdn.net/jpg/05/68/81/15/240_F_568811549_cddvPdfy3L8AFGNYsJmS45UwuWs2PNJr.jpg',
                        'count' => $packagingCount
                        ]
                    )

                @include(
                    'cards.dashboard.products',
                    [
                        'imagePath' => 'https://t4.ftcdn.net/jpg/02/83/46/39/240_F_283463951_Hdt61pKqT09VoIZEbEsi90LnLe9q0Qo8.jpg',
                        'count' => $productsCount
                        ]
                    )

            </div>
        </div>
    </section>
</x-app-layout>
