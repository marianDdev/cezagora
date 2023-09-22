<div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
    <a href="#">
        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" />
    </a>
    <!-- Modal toggle -->
    <button data-modal-target="delete-account" data-modal-toggle="delete-account"
            class="block text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
            type="button">
        Delete CezAgora account
    </button>

    <!-- Main modal -->
    <div id="delete-account" tabindex="-1" aria-hidden="true"
         class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <p class="font-light text-red-500 lg:mb-16 sm:text-xl">Are you sure you want to delete your account?</p>
                <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex justify-center items-center">

                    <form method="POST" action="{{ route('user.soft_delete', ['id' => Auth::user()->id]) }}" class="w-4/5 ">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" name="company_id" value="{{ Auth::user()->id }}" />
                        <x-primary-button class="mb-10">
                            {{ __('YES, delete my account') }}
                        </x-primary-button>
                    </form>

                    <form class="w-4/5 ">
                        <a href="{{ route('home') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">NO, take me back to homepage</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
