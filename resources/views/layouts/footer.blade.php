
<footer class="bg-white dark:bg-gray-900">
    <div class="mx-auto w-full max-w-screen-xl">
        <div class="grid grid-cols-2 gap-8 px-4 py-6 lg:py-8 md:grid-cols-4">
            <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Company</h2>
                <ul class="text-gray-500 dark:text-gray-400 font-medium">
                    <li class="mb-4">
                        <a href="{{ route('about') }}" class=" hover:underline">About</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="hover:underline">Careers</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="hover:underline">Brand Center</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="hover:underline">Blog</a>
                    </li>
                </ul>
            </div>
            <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Help center</h2>
                <ul class="text-gray-500 dark:text-gray-400 font-medium">
                    <li class="mb-4">
                        <a href="#" class="hover:underline">Twitter</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="hover:underline">Facebook</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('contact') }}" class="hover:underline">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h2>
                <ul class="text-gray-500 dark:text-gray-400 font-medium">
                    <li class="mb-4">
                        <a href="{{ route('advertising') }}" class="hover:underline">Advertising Policy</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="hover:underline">Brand Policy</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="hover:underline">Cookie Policy</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="hover:underline">Copyright Policy</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="hover:underline">General Policies</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="hover:underline">Privacy Policy</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                    </li>
                </ul>
            </div>
            <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Resources</h2>
                <ul class="text-gray-500 dark:text-gray-400 font-medium">
                    <li class="mb-4">
                        <a href="https://single-market-economy.ec.europa.eu/sectors/cosmetics/legislation_en" class="hover:underline" target="_blank">EU Legislation</a>
                    </li>
                    <li class="mb-4">
                        <a href="https://single-market-economy.ec.europa.eu/sectors/cosmetics/scientific-and-technical-assessment_en" class="hover:underline" target="_blank">Scientific and technical assessment</a>
                    </li>
                    <li class="mb-4">
                        <a href="https://single-market-economy.ec.europa.eu/sectors/cosmetics/cosmetic-ingredient-database_en" class="hover:underline" target="_blank">Cosmetic ingredient database</a>
                    </li>
                    <li class="mb-4">
                        <a href="https://single-market-economy.ec.europa.eu/sectors/cosmetics/cosmetic-product-notification-portal_en" class="hover:underline" target="_blank">Cosmetic product notification portal</a>
                    </li>
                </ul>
            </div>
        </div>
        @include('layouts._low_footer')
    </div>
</footer>
