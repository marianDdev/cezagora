<h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Select all documents that apply (optional)</h3>
<ul class="grid grid-cols-2 gap-4 w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex mb-6">

    @php
        $documentsCollection = collect($documents);
        $half = ceil($documentsCollection->count() / 2);
        $leftDocuments = $documentsCollection->slice(0, $half);
        $rightDocuments = $documentsCollection->slice($half);
    @endphp

    <div>
        @foreach($leftDocuments as $document)
            <li class="flex items-center w-full">
                <input id="{{ $document }}" value="{{ $document }}" name="documents[]"  {{ isset($ingredient) && in_array($document, $ingredient->documents->pluck('name')->toArray()) ? 'checked' : '' }} type="checkbox"
                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500 m-3">
                <label for="{{ $document }}"
                       class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $document }}</label>
            </li>
        @endforeach
    </div>

    <div>
        @foreach($rightDocuments as $document)
            <li class="flex items-center w-full">
                <input id="{{ $document }}" value="{{ $document }}" name="documents[]"  {{ isset($ingredient) &&  in_array($document, $ingredient->documents->pluck('name')->toArray()) ? 'checked' : '' }} type="checkbox"
                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500 m-3">
                <label for="{{ $document }}"
                       class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $document }}</label>
            </li>
        @endforeach
    </div>
</ul>
<div>
    <label for="other_document"
           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Other Document</label>
    <input type="text" name="other_document"
           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
    <x-input-error :messages="$errors->get('other_document')" class="mt-2" />
</div>
