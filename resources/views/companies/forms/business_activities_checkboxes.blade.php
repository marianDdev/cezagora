<h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Select all business activities that apply</h3>
<ul class="grid grid-cols-2 gap-4 w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex mb-6">

    @php
        $half = ceil($categories->count() / 2);
        $leftCategories = $categories->slice(0, $half);
        $rightCategories = $categories->slice($half);
    @endphp

    <div>
        @foreach($leftCategories as $category)
            <li class="flex items-center w-full">
                <input id="{{ $category->id }}" value="{{ $category->id }}" name="company_categories[]" type="checkbox" {{ in_array($category->id, $companyCategoryIds) ? 'checked' : '' }}
                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                <label for="{{ $category->id }}"
                       class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $category->name }}</label>
            </li>
        @endforeach
    </div>

    <div>
        @foreach($rightCategories as $category)
            <li class="flex items-center w-full">
                <input id="{{ $category->id }}" value="{{ $category->id }}" name="company_categories[]" type="checkbox" {{ in_array($category->id, $companyCategoryIds) ? 'checked' : '' }}
                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                <label for="{{ $category->id }}"
                       class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $category->name }}</label>
            </li>
        @endforeach
    </div>
    <x-input-error :messages="$errors->get('company_categories')" class="mt-2" />
</ul>
