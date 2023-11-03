<div>
    <div class="mb-6">
        <label for="country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select country</label>

        <select wire:model.live="selectedCountry" name="country"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="" selected>Choose country</option>
            @foreach($countries as $country)
                <option value="{{ $country->name }}">{{ $country->name }}</option>
            @endforeach
        </select>
        @include('components.error', ['field' => 'country'])
    </div>

    @if (!is_null($selectedCountry))
        <div class="mb-6">
            <label for="state"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select state or county</label>

            <select wire:model.live="selectedState" name="state"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" selected>Choose state</option>
                @foreach($states as $state)
                    <option value="{{ $state->name }}">{{ $state->name }}</option>
                @endforeach
            </select>
            @include('components.error', ['field' => 'state'])
        </div>
    @endif

    <div class="mb-6">
        <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select city</label>

        <div class="col-md-6">
            <select wire:model="selectedCity"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="city">
                <option value="" selected>Choose city</option>
                @foreach($cities as $city)
                    <option value="{{ $city->name }}">{{ $city->name }}</option>
                @endforeach
            </select>
            @include('components.error', ['field' => 'city'])
        </div>
    </div>
</div>
