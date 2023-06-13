<div class="mb-6 w-3/4">
    <h3 class="mb-10 mt-16 text-3xl font-extrabold leading-none tracking-tight text-blue-500 md:text-3xl lg:text-3xl dark:text-white text-center">upload multiple from csv or xls fil</h3>
    <form action="{{ route('ingredients.upload') }}" method="POST">
        @csrf
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
               for="user_avatar">Upload file</label>
        <input
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
            aria-describedby="user_avatar_help" id="user_avatar" type="file">
        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300"
             id="user_avatar_help">A profile picture is useful to confirm your are logged into your account
        </div>

    </form>
</div>
