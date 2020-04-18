<table>
    @foreach ($servicios_general as $service)
        {{ $service->nombre.$service->id
        }}
    @endforeach

</table>