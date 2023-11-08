<div>
    <div class="border-b border-gray-200 py-6">
        <h3 class="-my-3 flow-root">
            <div
                class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                aria-controls="filter-section-2" aria-expanded="false">
                <span class="font-medium text-gray-900">Availability</span>
            </div>
        </h3>
        <div class="pt-6" id="filter-section-2">
            <div class="space-y-4">
                <div class="flex items-center">
                    <select wire:model.live="availableAt" name="availability"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="{{ null }}">Select availability method</option>
                        @foreach($availabilityTypes as $availability)
                            <option value="{{ $availability }}">{{ $availability }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    @if($availableAt === \App\Services\Ingredient\IngredientServiceInterface::AVAILABLE_ON_DEMAND)
        <div class="border-b border-gray-200 py-6">
            <h3 class="-my-3 flow-root">
                <div
                    class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                    aria-controls="filter-section-2" aria-expanded="false">
                    <span class="font-medium text-gray-900">Max available date</span>
                </div>
            </h3>
            <div class="pt-6" id="filter-section-2">
                <div class="space-y-4">
                    <div class="flex items-center">
                        <input type="date" name="available_at"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                               min="{{ date('Y-m-d') }}">
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
