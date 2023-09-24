<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center']) }}>
    {{ $slot }}
</button>
