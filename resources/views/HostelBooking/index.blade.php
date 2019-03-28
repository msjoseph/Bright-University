@extends('base')

@section('title')
    Hostel Booking Requests
@endsection

@section('content')
    <div class="container-fluid sticky-top mt-2">
        @include('includes.navbar')
    </div>
    <div class="container-fluid mt-2">
        @if(count($bookedHostels) > 0)

            @foreach($bookedHostels as $bookedHostel)
                @foreach($hostels as $hostel)
                    @if($bookedHostel->hostel_id == $hostel->id)
                        {{$hostel->name}}
                    @endif
                @endforeach
            @endforeach

            @else
            <h3 class="text-danger text-center">No Booking Requests Found</h3>
        @endif
    </div>
    <div class="container-fluid mt-2">
        @include('includes.footer')
    </div>
@endsection