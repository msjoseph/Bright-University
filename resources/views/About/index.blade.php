@extends('base')
@section('title')
    Bright University | About
@endsection
@section('content')
    <div class="sticky-top" >
        @include('includes.navbar')
    </div>
    <div class="container mt-2 border-bottom">
        <h3 class="text-center">About Bright University</h3>
    </div>
    <div class="container mt-2" style="font-size: 1.1em">
        <p>Bright University is a public university located in Mombasa, Kenya.It was established in 2009 as a government plan
        to reduce the gap between skills required in the industry with what most youths had.It is one of the top ranked
            Universities in Kenya.We offer 100 courses to both Kenyan students and those from abroad.</p>
        <p>We offer <a href="{{url('/courses')}}">Degree Programs</a> of high quality, proven by 97 % rate of employment
            to our Alumni Students according to Kenya Today in 2018.This has been made possible
            by our hardworking qualified lecturers who are always ready to deliver to students.</p>
    </div>
    <div >
        @include('About.gallery')
    </div>
    <div class="container-fluid mt-2 mb-2">
        @include('includes.footer')
    </div>


@endsection