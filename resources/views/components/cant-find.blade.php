<section class="bg-red-100 dark:bg-gray-900 text-center p-6 m-6 border border-red-200 rounded-lg">
        <div class="mr-auto place-self-center lg:col-span-7">
            <h1 class="text-red-400 mb-4 text-xl font-extrabold tracking-tight leading-none dark:text-white">
                Can't find what you're looking for? Let us know, and we'll bring the right suppliers to you!
            </h1>
            <a href="{{ route('contact') }}"
               class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                {{ __('messages.get_in_touch') }}
            </a>
        </div>
</section>
