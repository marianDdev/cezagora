<div
    class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">
    <h2 class="text-gray-900 dark:text-white text-3xl font-extrabold mb-2">{{ $ingredient->ingredient->common_name ??  $ingredient->ingredient->name}}</h2>
    <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
        <img src="{{ url('/images/homepage/ingredients.jpeg') }}">
    </div>
    <p class="text-md font-normal text-gray-500 dark:text-gray-400 mb-4"><span
            class="font-bold">Price per item:</span> {{ $ingredient->price }}</p>
    <p class="text-md font-normal text-gray-500 dark:text-gray-400 mb-4"><span
            class="font-bold">Available quantity:</span> {{ $ingredient->quantity }}</p>
    <p class="text-md font-normal text-gray-500 dark:text-gray-400 mb-4"><span class="font-bold">Seller:</span> <a
            href="{{ route('company.show', ['slug' => $ingredient->company->slug]) }}"
            class="text-indigo-500">{{ \Illuminate\Support\Facades\Auth::user()->id === $ingredient->company->id ? 'You are the seller' : $ingredient->company->name }}</a></p>
    <p class="text-md font-normal text-gray-500 dark:text-gray-400 mb-4"><span
            class="font-bold">Function:</span> {{ strtolower($ingredient->ingredient->function) }}</p>
    @if(\Illuminate\Support\Facades\Auth::user()->id !== $ingredient->company->id)
        @include('ingredients.forms.add_to_cart', ['ingredient' => $ingredient])
    @endif
</div>
