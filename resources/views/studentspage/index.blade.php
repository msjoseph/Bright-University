@extends('base')
@section('title')
    Bright Students
@endsection
@section('content')
    <div class="sticky-top">
        @include('includes.navbar')
    </div>
    <div class="container-fluid mt-3">
        @if(!Auth::guest())
            @if(auth()->user()->is_student == true)
                @foreach($students as $student)
                    @if(auth()->user()->student_key == $student->user_key)
                        <div class="row">
                            <div class="col-lg-8 col-md-12 col-sm-12">
                                @include('studentspage.top_slider')
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12 mt-3">
                                @include('studentspage.student_details')
                            </div>
                        </div>
                    @endif
                @endforeach
                @else
                @include('studentspage.top_slider')
            @endif

            @else
            @include('studentspage.top_slider')
        @endif

    </div>
    <div class="container-fluid mt-3">
        @include('studentspage.exams')
    </div>
    <div class="container mt-3">
        <div class="container col-lg-12 border-bottom border-danger mb-2">
            <h3 class="text-center">This Week Recap</h3>
        </div>

        @include('studentspage.week_trend')
    </div>
    <div class="container-fluid mt-3">
        @include('studentspage.hostels')
    </div>
    <div class="container-fluid mt-3 mb-2">
        @include('includes.footer')
    </div>

@endsection