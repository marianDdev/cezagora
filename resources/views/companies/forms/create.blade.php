<x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex justify-center items-center">
        <form method="POST" action="{{ route('companies.store') }}" class="w-4/5 ">
            @csrf
            <livewire:other-company-category />
            <div class="mb-6">
                <x-text-input id="email" type="email" name="email" :value="old('email')" autofocus autocomplete="email" placeholder="office@yourcompany.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="mb-6">
                <x-text-input id="name" type="text" name="name" :value="old('name')" autofocus autocomplete="name" placeholder="Your Company LTD" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="mb-6">
                <x-text-input id="phone" type="text" name="phone" :value="old('phone')" autofocus autocomplete="phone"  placeholder="+40700000000" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
            <livewire:country-dropdown />
            <x-primary-button class="ml-4">
                {{ __('Add companies') }}
            </x-primary-button>
        </form>
    </div>
</x-app-layout>

