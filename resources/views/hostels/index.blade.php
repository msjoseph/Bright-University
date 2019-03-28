@extends('base')

@section('content')
    <style type="text/css">
        img{
            max-width: 100%;
            height: auto;
        }
    </style>
    <div class="container-fluid sticky-top mt-2">
        @include('includes.navbar')
    </div>
    <div class="container-fluid border-bottom border-danger mt-2 row">
        <div class="col-lg-4">
            <h3 class="text-center text-danger">Hostels and Bookings</h3>
        </div>
        <div class="col-lg-8">
            @if(!Auth::guest())
                @if(auth()->user()->is_hostel_owner == true)
                <a class="btn btn-info pull-right" href="{{url('hostels/create')}}">ADD HOSTEL
                    <i class="fa fa-angle-right ml-2" style="font-size: 20px"></i> </a>
                @else
                    @if(auth()->user()->is_student != true)
                        <a class="btn btn-info pull-right" href="{{url('HostelOwners/create')}}">Register as hostel owner
                            <i class="fa fa-angle-right ml-2" style="font-size: 20px"></i> </a>
                    @endif

                @endif
                @else
                <a class="btn btn-info pull-right" href="{{url('HostelOwners/create')}}">Register as hostel owner
                    <i class="fa fa-angle-right ml-2" style="font-size: 20px"></i> </a>
            @endif
        </div>
    </div>
    <div class="container-fluid mt-2">
        @if(count($hostels)>0)
            @foreach($hostels as $hostel)
                <div class="row border-bottom border-danger mb-2">
                    <div class="col-lg-4 mb-2">
                        <img src="/storage/hostel_images/{{$hostel->image}}" alt="{{$hostel->name}}">
                    </div>
                    <div class="col-lg-8 mb-2">
                        <h3 class="text-info text-center">{{$hostel->name}}</h3>
                        <div class="container-fluid row">
                            <div class="col-lg-6">
                                <p><small class="text-info">Has {{$hostel->rooms}} rooms</small></p>
                                <p><small class="text-info">{{$hostel->num_per_room}} students per room</small></p>
                                <p><small class="text-info">Ksh {{$hostel->rent}} per room per semester</small></p>
                                <p><small class="text-info">Payment Mode: {{$hostel->bank}}</small></p>
                                @if($hostel->rem_rooms >0)
                                    <p><small class="text-success">{{$hostel->rem_rooms}} rooms available</small></p>
                                    @if(!Auth::guest())
                                        @if(auth()->user()->is_student)
                                            {!! Form::open(['action' => 'HostelBookingController@store', 'method' => 'POST']) !!}
                                            <input type="hidden" name="hostel_id" value="{{$hostel->id}}">
                                            {{Form::submit('BOOK HOSTEL', ['class'=>'btn btn-primary '])}}
                                            {!! Form::close() !!}
                                        @endif
                                    @endif

                                @else
                                    <p><small class="text-danger">Fully occupied</small></p>
                                @endif
                            </div>
                            <div class="col-lg-6 row">


                                    @if(!Auth::guest())
                                        @foreach($bookedHostels as $bookedHostel)
                                            @if($bookedHostel->hostel_id == $hostel->id)
                                                @if(auth()->user()->id == $bookedHostel->user_id )
                                                    @if($bookedHostel->approved !=true)
                                                        @if($bookedHostel->is_cancelled == true)
                                                        <div class="col-lg-12">
                                                            <p><small class="text-danger">Your request has been rejected</small></p>
                                                            <p><small class="text-info">Cancel the current request then try again</small></p>
                                                            {!! Form::open(['action' => ['HostelBookingController@destroy',
                                                            $bookedHostel->id], 'method' => 'POST', 'class' => 'pull-left']) !!}
                                                            {{Form::hidden('_method', 'DELETE')}}
                                                            {{Form::submit('Cancel Request', ['class' => 'btn btn-danger'])}}
                                                            {!! Form::close() !!}
                                                        </div>
                                                            @else
                                                                <div class="col-lg-12">
                                                                    <p><small class="text-info">Request send. Pending Approval</small></p>
                                                                    {!! Form::open(['action' => ['HostelBookingController@destroy',
                                                                    $bookedHostel->id], 'method' => 'POST', 'class' => 'pull-left']) !!}
                                                                    {{Form::hidden('_method', 'DELETE')}}
                                                                    {{Form::submit('Cancel Request', ['class' => 'btn btn-danger'])}}
                                                                    {!! Form::close() !!}
                                                                </div>

                                                        @endif




                                                        @else
                                                        <div class="col-lg-12">
                                                            <p><small class="text-info">Your request has been approved</small></p>
                                                            <p><small class="text-info">Your room number is : </small><small class="text-danger">{{$bookedHostel->room_num}}</small> </p>
                                                        </div>
                                                            @endif

                                                @endif
                                            @endif
                                        @endforeach
                                    @endif

                                    @if(!Auth::guest())
                                        @if(auth()->user()->id == $hostel->user_id)
                                            <p class="text-info mt-5">
                                            <small>Booking Requests</small><a href="#" data-toggle="modal" data-target="#hostel{{$hostel->id}}">
                                                    <i class="text-success fa fa-briefcase ml-3 mr-2"></i></a>
                                            </p>
                                            <!--Bookings Modal-->
                                                <div class="modal fade" id="hostel{{$hostel->id}}" tabindex="-1" role="dialog" aria-labelledby="hostel{{$hostel->id}}Title" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="hostel{{$hostel->id}}Title"><small class="text-info">{{$hostel->name}} Hostel</small></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="container-fluid">
                                                                    <p class="text-center text-info border-bottom border-danger"><small>Booking Requests appear here</small></p>
                                                                    @foreach($bookedHostels as $bookedHostel)
                                                                        @if($bookedHostel->hostel_id == $hostel->id)
                                                                            @foreach($users as $user)
                                                                                @if($bookedHostel->user_id == $user->id)
                                                                                    @foreach($students as $student)
                                                                                        @if($user->student_key == $student->user_key)
                                                                                            <div class="row mt-1 border-bottom border-danger">
                                                                                                <div class="col-lg-2 mb-1">
                                                                                                    <img class="card-img-top" src="/storage/students_images/{{$student->profile_picture}}"
                                                                                                         alt="Card image cap">
                                                                                                </div>
                                                                                                <div class="col-lg-10 row mb-1">
                                                                                                    <div class="col-lg-6">
                                                                                                        <p><small class="text-info">{{$student->first_name}} {{$student->last_name}}</small></p>
                                                                                                        <p><small class="text-info">{{$student->email}}</small></p>
                                                                                                        <p><small class="text-info">{{$student->primary_phone}}</small></p>
                                                                                                    </div>
                                                                                                    <div class="col-lg-6 row">
                                                                                                        @if($bookedHostel->approved !=true)
                                                                                                            @if($bookedHostel->is_cancelled == true)
                                                                                                                <p><small class="text-danger">Request cancelled</small></p>
                                                                                                                @else
                                                                                                                <div class="col-lg-6">
                                                                                                                    <p><small class="text-danger">room number</small></p>
                                                                                                                    {!! Form::open(['action' => ['HostelBookingController@update', $bookedHostel->id],
                                                                                                                    'method' => 'POST',]) !!}
                                                                                                                    <input type="hidden" name="action" value="approve">
                                                                                                                    <div class="form-group">
                                                                                                                        {{Form::number('room','',['max' => $hostel->rooms, 'class' => 'form-control', 'required'])}}
                                                                                                                    </div>
                                                                                                                    {{Form::hidden('_method', 'PUT')}}
                                                                                                                    {{Form::submit('Approve', ['class' => 'btn btn-info pull-left'])}}

                                                                                                                    {!! Form::close() !!}
                                                                                                                </div>
                                                                                                                <div class="col-lg-6">
                                                                                                                    {!! Form::open(['action' => ['HostelBookingController@update', $bookedHostel->id],
                                                                                                                    'method' => 'POST', 'class' => 'pull-right mt-5']) !!}
                                                                                                                    <input type="hidden" name="action" value="cancel">
                                                                                                                    {{Form::hidden('_method', 'PUT')}}
                                                                                                                    {{Form::submit('Cancel request', ['class' => 'btn btn-danger pull-right'])}}
                                                                                                                    {!! Form::close() !!}
                                                                                                                </div>
                                                                                                            @endif
                                                                                                            @else
                                                                                                            <div class="col-lg-12">
                                                                                                                <p><small class="text-info">Request approved with room number {{$bookedHostel->room_num}}</small></p>
                                                                                                            </div>
                                                                                                        @endif


                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif

                                                                            @endforeach
                                                                        @endif
                                                                    @endforeach
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        @endif
                                    @endif


                            </div>
                        </div>
                        <div class="container-fluid">

                            @if(!Auth::guest())
                                @if(auth()->user()->id == $hostel->user_id)
                                    <a href="/hostels/{{$hostel->id}}/edit" class="btn btn-primary">Update</a>
                                    <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#delete{{$hostel->id}}">Remove</button>
                                @endif
                            @endif

                        </div>
                    </div>
                </div>


                <!--Delete Modal-->
                <div class="modal fade" id="delete{{$hostel->id}}" tabindex="-1" role="dialog" aria-labelledby="delete{{$hostel->id}}Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="delete{{$hostel->id}}Title"><small class="text-info">{{$hostel->name}}</small></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <p class="text-center"><small class="text-info">This process is irreversible</small> </p>
                                    {!! Form::open(['action' => ['HostelsController@destroy', $hostel->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        @endif
    </div>

    {{$hostels->links()}}

    <div class="container-fluid mb-3" style="margin-top: 20px">
        @include('includes.footer')
    </div>
@endsection
