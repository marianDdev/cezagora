<h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white mb-2">
    My company
</h3>
<p class="text-gray-500 dark:text-gray-400"><span class="font-bold">Name:</span> {{ $title }}</p>
<p class="text-gray-500 dark:text-gray-400"><span class="font-bold">Email:</span> {{ $email }}</p>
<p class="text-gray-500 dark:text-gray-400"><span class="font-bold">Phone:</span> {{ $phone }}</p>
<p class="text-gray-500 dark:text-gray-400"><span class="font-bold">CezAgora user:</span> {{ $admin }}</p>

<!-- Modal toggle -->
<button data-modal-target="edit-company" data-modal-toggle="edit-company"
        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
        type="button">
    Update your company's details
</button>

<!-- Main modal -->
<div id="edit-company" tabindex="-1" aria-hidden="true"
     class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="edit-company">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex justify-center items-center">

                <form method="POST" action="{{ route('company.update') }}" class="w-4/5 ">
                    @method('PATCH')
                    @csrf
                    <input type="hidden" name="company_id" value="{{ Auth::user()->company->id }}" />
                    <div class="mb-6">
                        @include('companies.forms.business_activities_checkboxes')
                        <x-text-input id="email" type="email" name="email" value="{{ $company->email }}" autofocus
                                      autocomplete="email"
                                      placeholder="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <x-text-input id="name" type="text" name="name" value="{{ $company->name }}" autofocus
                                      autocomplete="name"
                                      placeholder="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <x-text-input id="phone" type="text" name="phone" value="{{ $company->phone }}" autofocus
                                      autocomplete="phone"
                                      placeholder="phone" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <select id="mcc" name="mcc"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Select your merchant category code</option>
                            @foreach($mccs as $mcc)
                                <option value="{{ $mcc->code }}">{{ $mcc->code }} - {{ $mcc->description }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('mcc')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <x-text-input id="product_description" type="text" name="product_description"
                                      value="{{ $company->product_description }}" autofocus autocomplete="product_description"
                                      placeholder="Short description of your products or services" />
                        <x-input-error :messages="$errors->get('product_description')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <x-text-input id="website" type="text" name="website" value="{{ $company->website }}" autofocus
                                      autocomplete="website" placeholder="Website or social media page URL" />
                        <x-input-error :messages="$errors->get('website')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <x-text-input id="tax_id" type="text" name="tax_id" value="{{ $company->tax_id }}" autofocus
                                      autocomplete="tax_id" placeholder="Tax ID" />
                        <x-input-error :messages="$errors->get('tax_id')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <x-text-input id="vat_id" type="text" name="vat_id" value="{{ $company->vat_id }}" autofocus
                                      autocomplete="vat_id" placeholder="VAT ID" />
                        <x-input-error :messages="$errors->get('vat_id')" class="mt-2" />
                    </div>
                    <livewire:country-dropdown />
                    <x-primary-button class="mb-10">
                        {{ __('Update company') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</div>
