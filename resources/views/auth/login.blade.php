<x-layout>
    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
                <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg"
                     alt="logo">
                CezAgora
            </a>
            <div
                class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Login
                    </h1>
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" type="email" name="email" :value="old('email')" autofocus autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" type="password" name="password" :value="old('password')" autofocus autocomplete="password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <x-primary-button class="ml-4">
                            {{ __('Login') }}
                        </x-primary-button>
                        <p class="text-sm font-light text-gray-500">
                            Forgot your password? <a href="{{ route('password.request') }} class="font-medium text-primary-600 hover:underline"> Click here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>
