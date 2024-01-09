<x-app-layout>
    <script src="https://js.stripe.com/v3/"></script>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        @if(is_null($order))
            <div class="bg-white p-4 rounded-lg shadow-md text-center">
                <p class="text-gray-500 dark:text-gray-400">Your cart is empty.</p>
            </div>
        @else
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Order Items (Left Part) -->
                <div class="flex-1 bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-lg font-medium mb-4">Your Order</h2>

                    <table class="w-full text-sm text-gray-500 dark:text-gray-400">
                        <thead class="text-sm text-blue-500 uppercase bg-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-3">Seller</th>
                                <th scope="col" class="px-6 py-3">Product type</th>
                                <th scope="col" class="px-6 py-3">Product name</th>
                                <th scope="col" class="px-6 py-3">Quantity</th>
                                <th scope="col" class="px-6 py-3">Price</th>
                                <th scope="col" class="px-6 py-3">Total</th>
                                <th scope="col" class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr class="border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->seller->name }}</th>
                                    <td class="px-6 py-4 text-indigo-500">{{ $item->item_type }}</td>
                                    <td class="px-6 py-4">{{ $item->name }}</td>
                                    <td class="px-6 py-4">{{ $item->quantity }}</td>
                                    <td class="px-6 py-4">{{ \App\Models\Setting::DEFAULT_CURRENCY_SYMBOL . $item->price / 100}}</td>
                                    <td class="px-6 py-4">{{ \App\Models\Setting::DEFAULT_CURRENCY_SYMBOL . ($item->total / 100)}}</td>
                                    <td class="px-6 py-4">
                                        @include('cart._delete_modal')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Payment Form (Right Part) -->
                <div class="flex-1 bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-lg font-medium mb-4">Payment</h2>

                    <form method="post" action="{{ route('payment.charge') }}" id="payment-form">
                        @csrf
                        <!-- Card Payment Input -->
                        <div class="mb-4">
                            <div id="card-element" class="p-2 border rounded"></div>
                            <div id="card-errors" role="alert" class="text-red-500 mt-2"></div>
                        </div>

                        <x-primary-button class="w-full mt-6">
                            Buy now for {{ \App\Models\Setting::DEFAULT_CURRENCY_SYMBOL . ($order->total_price / 100) }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
            <script>
                let stripePublicKey = "{{ config('stripe.publishable') }}";
                let stripe          = Stripe(stripePublicKey);
                let elements        = stripe.elements();
                let card            = elements.create('card');
                card.mount('#card-element');

                card.addEventListener('change', function (event) {
                    const displayError = document.getElementById('card-errors');
                    if ( event.error ) {
                        displayError.textContent = event.error.message;
                    } else {
                        displayError.textContent = '';
                    }
                });

                const form = document.getElementById('payment-form');
                form.addEventListener('submit', async function (event) {
                    event.preventDefault();

                    const {paymentMethod, error } = await stripe.createPaymentMethod({
                                                                   type : 'card',
                                                                   card : card,
                                                               });

                    if (error) {
                        document.getElementById('card-errors').textContent = error.message;
                    }else {
                        fetch('/payments/create-intent', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                                     paymentMethodId: paymentMethod.id,
                                                 })
                        })
                            .then(response => response.json())
                            .then(data => {
                                // Confirm the card payment using the client secret received from the backend
                                stripe.confirmCardPayment(data.clientSecret, {
                                    payment_method: paymentMethod.id,
                                }).then(function(confirmResult) {
                                    if (confirmResult.error) {
                                        // Handle errors here
                                        document.getElementById('card-errors').textContent = confirmResult.error.message;
                                    } else {
                                        // PaymentIntent was successfully confirmed
                                        if (confirmResult.paymentIntent.status === 'succeeded') {
                                            // Redirect or update the UI on success
                                            window.location.href = '/payment/success'; // Redirect to a success page
                                        }
                                    }
                                });
                            })
                            .catch(error => {
                                // Handle errors from fetch here
                                console.error('Error:', error);
                            });
                    }
                });
            </script>
        @endif
    </div>
</x-app-layout>
