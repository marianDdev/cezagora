<x-app-layout>
    <script src="https://js.stripe.com/v3/"></script>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-medium mb-4">Complete Payment</h2>
            <p>Please complete the additional authentication required to finalize your payment.</p>

            <div id="card-errors" role="alert" class="text-red-500 mt-2"></div>
            <!-- Add any additional information or instructions here -->
        </div>
    </div>

    <script>
        let stripe = Stripe("{{ config('stripe.publishable') }}");

        window.onload = function() {
            stripe.confirmCardPayment("{{ $clientSecret }}").then(function(result) {
                if (result.error) {
                    // Display error message
                    document.getElementById('card-errors').textContent = result.error.message;
                } else {
                    // The payment has been processed, you can redirect or update the UI
                    if (result.paymentIntent.status === 'succeeded') {
                        window.location.href = "/path-to-success-page"; // Redirect to a success page
                    } else {
                        // Handle other statuses accordingly
                    }
                }
            });
        };
    </script>
</x-app-layout>
