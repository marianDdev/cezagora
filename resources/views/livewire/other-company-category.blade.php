<div class="mb-6">
    <label for="company_category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select your company's category</label>
    <select wire:model="otherCategory" id="company_category_id" name="company_category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option selected>Select your company category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
        <option value="true">Other</option>
    </select>

    @if($otherCategory === 'true')
    <div class="mb-6">
        <x-input-label for="company_category_id" :value="__('Add other company category')" />
        <x-text-input id="company_category_id" type="text" name="company_category_id" :value="old('company_category_id')" autofocus autocomplete="type" />
        <x-input-error :messages="$errors->get('company_category_id')" class="mt-2" />
    </div>
    @endif
</div>
