<div>
    <div class="border-b border-gray-200 py-6">
        <div class="pt-6" id="filter-section-2">
            <div class="space-y-4">
                <div class="flex items-center">
                    <form action="{{ route('language.switch') }}" method="POST">
                        @csrf
                    <select name="language" onchange="this.form.submit()"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }} >English</option>
                        <option value="ro" {{ app()->getLocale() === 'ro' ? 'selected' : '' }} >Romanian</option>
                        <option value="de" {{ app()->getLocale() === 'de' ? 'selected' : '' }}>German</option>
                        <option value="fr" {{ app()->getLocale() === 'fr' ? 'selected' : '' }}>French</option>
                        <option value="es" {{ app()->getLocale() === 'es' ? 'selected' : '' }}>Spanish</option>
                    </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
