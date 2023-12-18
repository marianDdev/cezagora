@php
    $codeToFlagMap = [
                'en' => \Nnjeim\World\Models\Country::where('iso2', 'GB')->first()->emoji,
                'pl' => \Nnjeim\World\Models\Country::where('iso2', 'PL')->first()->emoji,
                'ro' => \Nnjeim\World\Models\Country::where('iso2', 'RO')->first()->emoji,
                'de' => \Nnjeim\World\Models\Country::where('iso2', 'DE')->first()->emoji,
                'fr' => \Nnjeim\World\Models\Country::where('iso2', 'FR')->first()->emoji,
                'es' => \Nnjeim\World\Models\Country::where('iso2', 'ES')->first()->emoji,
            ];

            $codeToLanguageMap = [
                'en' => 'English',
                'ro' => 'Română',
                'pl' => 'Polski',
                'de' => 'Deutsch',
                'fr' => 'Français',
                'es' => 'Español',
            ];

            $flags = [];

            foreach ($codeToFlagMap as $code => $flag) {
                $flags[$code] = $flag;
            }
@endphp

<div id="filter-section-2">
    <div class="flex items-center">
        <form action="{{ route('language.switch') }}" method="POST">
            @csrf
            <select name="language" onchange="this.form.submit()"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach($codeToLanguageMap as $code => $language)
                    <option value="{{ $code }}" {{ app()->getLocale() === $code ? 'selected' : '' }} >{{ $flags[$code] . ' ' .$language }}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>
