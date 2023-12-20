<div x-data="{ rating: 0, showModal: false }">
    <div class="mb-2">
        <p class="text-lg font-semibold">Rate the seller</p>
    </div>
    <div class="flex items-center">
        @for ($i = 1; $i <= 5; $i++)
            <svg @click="rating = {{ $i }}; showModal = true;" :class="{ 'text-yellow-300': rating >= {{ $i }}, 'text-gray-300': rating < {{ $i }} }" class="w-4 h-4 cursor-pointer ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
            </svg>
        @endfor
    </div>

    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" x-cloak>
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="flex justify-end">
                <button @click="showModal = false" class="text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Submit Your Rating</h3>

                <div class="flex justify-center mt-2">
                    <template x-for="i in 5" :key="i">
                        <svg :class="{ 'text-yellow-300': i <= rating, 'text-gray-300': i > rating }" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                    </template>
                </div>

                <div class="mt-2">
                    <form method="POST" action="{{ route('rating.submit') }}">
                        @csrf
                        <input type="hidden" name="reviewee_id" value="{{ $seller->id }}">
                        <input type="hidden" name="reviewer_id" value="{{ $company->id }}">
                        <input type="hidden" name="rating" x-model="rating" />
                        <textarea name="comment" class="w-full rounded"></textarea>
                        <button type="submit" class="mt-2 px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
