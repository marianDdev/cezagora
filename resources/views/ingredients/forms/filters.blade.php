<form class="hidden lg:block" action="{{ route('ingredients') }}" method="GET" id="filters">
    <div class="border-b border-gray-200 py-6">
        <h3 class="-my-3 flow-root">
            <!-- Expand/collapse section button -->
            <div
                class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                aria-controls="filter-section-0" aria-expanded="false">
                <span class="font-medium text-gray-900">Seller</span>
            </div>
        </h3>
        <!-- Filter section, show/hide based on section state. -->
        <div class="pt-6" id="filter-section-0">
            <div class="space-y-4">
                <select name="company_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="{{ null }}">Filter by seller</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ !is_null($authCompany) && $authCompany->id === $company->id ? 'You' : $company->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="border-b border-gray-200 py-6">
        <h3 class="-my-3 flow-root">
            <div
                class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                aria-controls="filter-section-1" aria-expanded="false">
                <span class="font-medium text-gray-900">INCI name</span>
            </div>
        </h3>
        <!-- Filter section, show/hide based on section state. -->
        <div class="pt-6" id="filter-section-1">
            <div class="space-y-4">
                <div class="flex items-center">
                    <input type="text" name="name"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
            </div>
        </div>
    </div>
    <div class="border-b border-gray-200 py-6">
        <h3 class="-my-3 flow-root">
            <!-- Expand/collapse section button -->
            <div
                class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                aria-controls="filter-section-2" aria-expanded="false">
                <span class="font-medium text-gray-900">Common name</span>
            </div>
        </h3>
        <!-- Filter section, show/hide based on section state. -->
        <div class="pt-6" id="filter-section-2">
            <div class="space-y-4">
                <div class="flex items-center">
                    <input type="text" name="common_name"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
            </div>
        </div>
    </div>
    <div class="border-b border-gray-200 py-6">
        <h3 class="-my-3 flow-root">
            <!-- Expand/collapse section button -->
            <div
                class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                aria-controls="filter-section-2" aria-expanded="false">
                <span class="font-medium text-gray-900">Function</span>
            </div>
        </h3>
        <!-- Filter section, show/hide based on section state. -->
        <div class="pt-6" id="filter-section-2">
            <div class="space-y-4">
                @foreach($functions as $function)
                    <div class="flex items-center">
                        <input name="functions[]" type="checkbox"
                               class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                               value="{{ $function }}">
                        <label for="functions[]" class="ml-3 text-sm text-gray-600">{{ $function }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="border-b border-gray-200 py-6">
        <h3 class="-my-3 flow-root">
            <!-- Expand/collapse section button -->
            <div
                class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                aria-controls="filter-section-2" aria-expanded="false">
                <span class="font-medium text-gray-900">Price</span>
            </div>
        </h3>
        <!-- Filter section, show/hide based on section state. -->
        <div class="pt-6" id="filter-section-2">
            <div class="space-y-4">
                <div class="flex items-center">
                    <div class="flex items-center">
                        <input type="number" name="min_price"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mr-3"
                               placeholder="min price">
                        <input type="number" name="max_price"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                               placeholder="max price">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <livewire:show-available-at />
    <button type="submit"
            class="bg-indigo-600 text-white text-sm leading-6 font-medium py-2 px-3 rounded-lg mt-6">Apply filters
    </button>
    <button type="submit"
            class="bg-indigo-600 text-white text-sm leading-6 font-medium py-2 px-3 rounded-lg mt-6">
        <a href="{{ route('ingredients') }}">
            Clear filters
        </a>
    </button>

</form>
<script>
    function clearFilters() {
        let form = document.querySelector('#filters'); // Replace with your form's class
        form.reset();
        form.submit();
    }
</script>
