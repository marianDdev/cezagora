<div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
    <div>
        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg"
             src="https://t4.ftcdn.net/jpg/02/95/09/37/240_F_295093725_LltVZ9dJ8gagY12DFTGbMYwzUlFUTIWf.jpg" />
    </div>
    <div class="p-5">
        <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input
                class="mb-2 block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" type="file" name="import_file">
            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Upload
            </button>
        </form>

    </div>
</div>
