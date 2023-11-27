<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>CezAgora</title>
        @vite(['resources/css/app.css','resources/js/app.js'])
        @livewireStyles
    </head>
    <body>
        <section class="max-w-2xl px-6 py-8 mx-auto bg-white dark:bg-gray-900">
            <header>
                <a href="https://www.cezagora.com">
                    <img class="w-72 h-72" src="{{ url('/images/logo.png') }}" alt="CezAgora Logo">
                </a>

                <nav class="flex items-center mt-6 gap-x-6 sm:gap-x-8">
                    <a href="https://www.cezagora.com" class="text-sm text-blue-600 transition-colors duration-300 hover:text-blue-500 dark:text-gray-300 dark:hover:text-blue-400" aria-label="Reddit"> Home </a>
                    <a href="https://www.cezagora.com/help" class="text-sm text-blue-600 transition-colors duration-300 hover:text-blue-500 dark:text-gray-300 dark:hover:text-blue-400" aria-label="Reddit"> Help </a>
                    <a href="https://www.cezagora.com/contact" class="text-sm text-blue-600 transition-colors duration-300 hover:text-blue-500 dark:text-gray-300 dark:hover:text-blue-400" aria-label="Reddit"> Contact </a>
                </nav>
            </header>

            <main class="mt-8">
                <img class="object-cover w-full h-56 rounded-lg md:h-72" src="https://t3.ftcdn.net/jpg/02/86/03/88/240_F_286038864_A5gW3dZMOjWH5YsETozisZ91DA3joClp.jpg" alt="">

                <h2 class="mt-6 text-gray-700 dark:text-gray-200 font-bold text-xl">Hello {{ $user->first_name}},</h2>

                <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
                    We're delighted to welcome you to CezAgora, the dedicated hub made for cosmetics. As a professional within the cosmetics industry, you're now in the perfect place to discover and connect with manufacturers, distributors, and innovators.
                </p>
                <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
                    Embrace the world of cosmetics like never before with CezAgora. Start by exploring our extensive range of products and services designed to empower your business, from high-quality raw materials to cutting-edge marketing services.
                </p>

                <p class="mt-4 text-gray-600 dark:text-gray-300">
                    Thanks, <br>
                    CezAgora Team
                </p>

                <button class="px-6 py-2 mt-8 text-sm font-medium tracking-wider text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                    <a href="https://www.cezagora.com/login">Login</a>
                </button>
            </main>


            <footer class="mt-8">
                <p class="mt-3 text-gray-500 dark:text-gray-400"><span class="text-sm text-gray-500 dark:text-gray-300 sm:text-center">Committed to Your Privacy</span></p>
                <p class="mt-3 text-gray-500 dark:text-gray-400"><span class="text-sm text-gray-500 dark:text-gray-300 sm:text-center">Your privacy and data security are paramount to us. All information on our platform is treated with the highest standard of confidentiality and is fully compliant with data protection regulations.</span></p>

                <p class="mt-3 text-gray-500 dark:text-gray-400"><span class="text-sm text-gray-500 dark:text-gray-300 sm:text-center">© {{\Carbon\Carbon::now()->year}} <a href="https://cezius.tech">Cezius Link™</a>. All Rights Reserved.</span></p>
            </footer>
        </section>
        @livewireScripts
    </body>
</html>
