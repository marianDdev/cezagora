<x-app-layout>
    <h1>After you submit the requested info you will be redirected to stripe for the payment account onboarding</h1>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex justify-center items-center">
        <form method="POST" action="{{ route('companies.store') }}" class="w-4/5 ">
            @csrf
            <livewire:other-company-category />
            <div class="mb-6">
                <x-text-input id="email" type="email" name="email" :value="old('email')" autofocus autocomplete="email" placeholder="office@yourcompany.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="mb-6">
                <x-text-input id="name" type="text" name="name" :value="old('name')" autofocus autocomplete="name" placeholder="Your Company's name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="mb-6">
                <x-text-input id="phone" type="text" name="phone" :value="old('phone')" autofocus autocomplete="phone"  placeholder="+40700000000" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
            <div class="mb-6">
                <x-text-input id="mcc" type="text" name="mcc" :value="old('mcc')" autofocus autocomplete="mcc" placeholder="Your Company's merchant category code" />
                <x-input-error :messages="$errors->get('mcc')" class="mt-2" />
            </div>
            <div class="mb-6">
                <x-text-input id="product_description" type="text" name="product_description" :value="old('product_description')" autofocus autocomplete="mcc" placeholder="Short description of your products or services" />
                <x-input-error :messages="$errors->get('product_description')" class="mt-2" />
            </div>
            <div class="mb-6">
                <x-text-input id="website" type="text" name="website" :value="old('website')" autofocus autocomplete="website" placeholder="Website or social media page URL" />
                <x-input-error :messages="$errors->get('website')" class="mt-2" />
            </div>
            <div class="mb-6">
                <x-text-input id="tax_id" type="text" name="tax_id" :value="old('tax_id')" autofocus autocomplete="tax_id" placeholder="Tax ID" />
                <x-input-error :messages="$errors->get('tax_id')" class="mt-2" />
            </div>
            <div class="mb-6">
                <x-text-input id="vat_id" type="text" name="vat_id" :value="old('vat_id')" autofocus autocomplete="vat_id" placeholder="VAT ID" />
                <x-input-error :messages="$errors->get('vat_id')" class="mt-2" />
            </div>
            <livewire:country-dropdown />
            <x-primary-button class="ml-4">
                {{ __('Add company') }}
            </x-primary-button>
        </form>
    </div>
</x-app-layout>

