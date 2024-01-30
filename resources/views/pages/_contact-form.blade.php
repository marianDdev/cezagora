<section class="bg-white dark:bg-gray-900">
    <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-red-400 dark:text-white">Contact Us</h2>
        <p class="mb-8 lg:mb-16 font-light text-center text-red-400 dark:text-red-400 sm:text-xl">Send us a message with more details and we will try to work something for you.</p>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('contact-message.store') }}" class="space-y-8" method="POST">
            @csrf
            @if(\Illuminate\Support\Facades\Auth::check() === false)
            <div>
                <input type="text" name="full_name"
                       class="shadow-sm bg-red-50 border border-red-300 text-red-400 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                       placeholder="Full name">
            </div>
            <div>
                <label for="company"
                       class="block mb-2 text-sm font-medium text-red-400 dark:text-red-300">Your company</label>
                <input type="text" id="company" name="company"
                       class="shadow-sm bg-red-50 border border-red-300 text-red-400 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                       placeholder="your company name">
            </div>
            <div>
                <label for="email"
                       class="block mb-2 text-sm font-medium text-red-400 dark:text-red-300">Your email</label>
                <input type="email" id="email" name="email"
                       class="shadow-sm bg-red-50 border border-red-300 text-red-400 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                       placeholder="name@cezagora.com">
            </div>
            @else
            <input type="hidden" name="full_name"
                   value="{{ \Illuminate\Support\Facades\Auth::user()->first_name . ' ' . \Illuminate\Support\Facades\Auth::user()->last_name}}">

            @if(\Illuminate\Support\Facades\Auth::user()->company !== null)
            <input type="hidden" name="company"
                   value="{{ \Illuminate\Support\Facades\Auth::user()->company->name }}">
            @else
            <div>
                <label for="company"
                       class="block mb-2 text-sm font-medium text-red-400 dark:text-red-300">Your company</label>
                <input type="text" id="company" name="company"
                       class="shadow-sm bg-red-50 border border-red-300 text-red-400 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                       placeholder="your company name">
            </div>
            @endif
            <input type="hidden" name="email" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}">
            @endif
            <div>
                <label for="subject"
                       class="block mb-2 text-sm font-medium text-red-400 dark:text-red-300">Subject</label>
                <input type="text" id="subject" name="subject"
                       class="block p-3 w-full text-sm text-red-400 bg-red-50 rounded-lg border border-red-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                       placeholder="Let us know how we can help you">
            </div>
            <div class="sm:col-span-2">
                <label for="message"
                       class="block mb-2 text-sm font-medium text-red-400 dark:text-red-400">Your message</label>
                <textarea id="message" name="message" rows="6"
                          class="block p-2.5 w-full text-sm text-red-400 bg-red-50 rounded-lg shadow-sm border border-red-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                          placeholder="Leave a comment..."></textarea>
            </div>
            <button type="submit" class="ml-4 text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Send
            </button>
        </form>
    </div>
</section>
