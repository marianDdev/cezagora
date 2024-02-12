<x-app-layout>
    <p>couriers</p>
    @foreach($couriers as $courier)
        @foreach($courier as $key => $value)
            <p>{{ $key }}: {{ $value }}</p>
        @endforeach
    @endforeach

    <hr class="py-24" />

    <p>services</p>
    @foreach($services as $service)
        @foreach($service as $key => $value)
            <p>{{ $key }}: {{ $value }}</p>
        @endforeach
    @endforeach

    <hr class="py-24" />

    <p>addresses</p>
    <p>total: {{ $address['total'] }}</p>
    <p>is empty?: {{ $address['total'] }}</p>
    @foreach($address['list'] as $key => $value)
        <p>{{ $key }}: {{ $value }}</p>
    @endforeach

    <hr class="py-24" />

    <p>countries</p>
    @foreach($countries as $index => $country)
        @foreach($country as $key => $value)
            <p>{{ $key }}: {{ $value }}</p>
        @endforeach
    @endforeach


    <hr  class="py-24"/>

    <p>counties</p>
    @foreach($counties as $index => $county)
        @foreach($county as $key => $value)
            <p>{{ $key }}: {{ $value }}</p>
        @endforeach
    @endforeach
</x-app-layout>
