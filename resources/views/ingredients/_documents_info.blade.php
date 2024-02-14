<div class="relative group">
    <button type="button" data-modal-target="docs-info-modal-{{ $ingredient->id }}" data-modal-toggle="docs-info-modal-{{ $ingredient->id }}"
            class="text-red-700 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm p-2 inline-flex items-center justify-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:hover:bg-gray-700">
        <span id="default-message" class="inline-flex items-center">
            <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z"/>
            </svg>
            <span class="text-xs font-semibold">Display documents</span>
        </span>
    </button>
    <div class="absolute bottom-full mb-2 hidden group-hover:block">
        <span class="text-xs text-white bg-black rounded py-1 px-3">Delivery Documents</span>
    </div>
</div>

<!-- Main modal -->
<div id="docs-info-modal-{{ $ingredient->id }}" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex justify-end p-2">
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-full text-sm h-8 w-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="docs-info-modal-{{ $ingredient->id }}">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            @if($ingredient->documents->count() > 0)
            <div class="p-4 md:p-5">
                <p class="text-lg font-semibold">Delivery Documents</p>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <ul class="my-4 space-y-3">
                    @foreach($ingredient->documents as $document)
                        <li>
                            <div
                                class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                <span class="flex-1 ms-3 whitespace-nowrap">{{ $document->name }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            @else
                <div class="p-4 md:p-5">
                    <p class="text-lg font-semibold">No delivery documents available</p>
                </div>
            @endif
        </div>
    </div>
</div>
