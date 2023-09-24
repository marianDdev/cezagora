<x-app-layout>
    <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700 ">

        <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">It looks like your account is deactivated.</h2>
            <p class="mb-5 font-light text-gray-500 sm:text-xl dark:text-gray-400">We would be more than happy to see you back in the CezAgora Community.</p>
            <p class="mb-5 font-light text-gray-500 sm:text-xl dark:text-gray-400">Just click on the <span class="font-bold text-green-500" data-modal-target="activate-account">activate account button</span> and no more steps are required.</p>

            <x-green-button data-modal-target="activate-account" data-modal-toggle="activate-account">
                {{ __('activate account') }}
            </x-green-button>

{{--            <button data-modal-target="activate-account" data-modal-toggle="activate-account"--}}
{{--                    class="block text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"--}}
{{--                    type="button">--}}
{{--                activate account--}}
{{--            </button>--}}

            <div id="activate-account" tabindex="-1" aria-hidden="true"
                 class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 pt-6">
                        <p class="font-light text-red-500 lg:mb-16 sm:text-xl">Confirm account reactivation</p>
                        <button type="button"
                                class="absolute top-3 right-2.5 text-red-500 bg-red-50 hover:bg-red-700 hover:text-red-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white p-6"
                                data-modal-hide="authentication-modal">x
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex justify-center items-center">

                            <form method="POST" action="{{ route('user.toggle.activate', ['id' => Auth::user()->id]) }}"
                                  class="w-4/5 p-6">
                                <input type="hidden" name="activate" value="1">
                                <input type="hidden" name="deleted_at" value="{{ null }}">
                                @method('PATCH')
                                @csrf
                                <input type="hidden" name="company_id" value="{{ Auth::user()->id }}" />
                                <x-green-button class="mb-10">
                                    {{ __('YES, re-activate my account') }}
                                </x-green-button>
                            </form>

                            <form method="POST" action="{{ route('logout') }}" class="w-4/5 p-6">
                                @csrf
                                <x-red-button class="mb-10">
                                    {{ __('NO, keept it deactivated') }}
                                </x-red-button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
