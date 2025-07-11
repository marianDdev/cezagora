<div
    class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">
    <h2 class="text-red-400 dark:text-white text-3xl font-extrabold mb-2">Branding</h2>
    <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
        <img src="https://cezagora.fra1.cdn.digitaloceanspaces.com/homepage/branding.png">
    </div>
    <p class="text-lg font-normal text-gray-500 dark:text-gray-400 mb-4">Elevate your cosmetic brand with expert branding solutions. Achieve a distinct and memorable identity in the competitive market. Connect with top industry professionals today.</p>
    <a href="{{ route('services.index', ['type' => \App\Services\Service\ServicesServiceInterface::BRANDING]) }}"
       class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Go to branding specialists list
        <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
             viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M1 5h12m0 0L9 1m4 4L9 9" />
        </svg>
    </a>
</div>
