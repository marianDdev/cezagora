<x-guest-layout>
    <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Connect with Stripe to get started</h5>
        </a>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Stripe Connect is the fastest and easiest way to integrate payments into CezAgora marketplace. Please complet this short onboarding steps to be able to receive payments for your products and services.</p>
        <a href="{{ route('onboarding.redirect') }}"
           class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Clicke here to connect with stripe
        </a>
    </div>
</x-guest-layout>
