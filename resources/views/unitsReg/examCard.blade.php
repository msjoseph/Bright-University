
<div class="container">
<table class="table table-striped" style="background:red">
    <tr>
        <th>Unit Code</th>
        <th>Unit Name</th>
        <th>SuperVisor Signature</th>
    </tr>
    @foreach ($registeredUnits as $registeredUnit)
        @foreach ($units as $unit)
            @if ($registeredUnit->unit_id == $unit->id)
                <tr>
                    <td>{{ $unit->id }}</td>
                    <td>{{ $unit->name }}</td>
                    <td></td>
                </tr>
            @endif

        @endforeach

    @endforeach
</table>
</div>

