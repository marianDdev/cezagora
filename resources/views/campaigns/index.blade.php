<x-app-layout>
    <ul>
        @foreach($campaigns as $campaign)
            <li>Name:{{ $campaign->name }}</li>
            <li>Start date: {{ \Carbon\Carbon::parse($campaign->start_at)->format('Y-m-d') }}</li>
            <li>End date: {{ $campaign->end_at ? \Carbon\Carbon::parse($campaign->end_at)->format('Y-m-d') : 'None' }}</li>
            <li>Limit: {{ $campaign->limit }}</li>
        @endforeach
    </ul>
</x-app-layout>
