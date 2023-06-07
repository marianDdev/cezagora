<x-app-layout>
    <form method="POST" action="{{ route('company.store') }}">
        @csrf
        <div class="mb-6">
            <label for="company_category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select your company's category</label>
            <select id="company_category_id" name="company_category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Select your company category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @include('components.error', ['field' => 'company_category_id'])
        </div>
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

