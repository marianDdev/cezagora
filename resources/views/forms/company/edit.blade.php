<x-app-layout>
    <form method="POST" action="{{ route('company.store') }}">
        @csrf
        <livewire:other-company-category />
        <div class="mb-6">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" autofocus autocomplete="first_name" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="mb-6">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" autofocus autocomplete="first_name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="mb-6">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" type="text" name="phone" :value="old('phone')" autofocus autocomplete="first_name" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
        <livewire:country-dropdown />
        <x-primary-button class="ml-4">
            {{ __('Add company') }}
        </x-primary-button>
    </form>
</x-app-layout>

