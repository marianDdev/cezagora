<h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Sellect all business activities that apply</h3>
<ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex mb-6">
    <div>
        @foreach($categories as $category)
            <li class="w-full border-b border-gray-200">
                <input id="{{ $category->id }}" value="{{ $category->id }}" name="company_categories[]" type="checkbox"
                       value=""
                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                <label
                       class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $category->name }}</label>
            </li>
        @endforeach
    </div>
</ul>
