@extends('base')
@section('title')
    BrightDrive | Shared Files
@endsection

@section('content')
    <div class="sticky-top">
        @include('includes.drivenav')
    </div>
    @if(count($SharedFiles) > 0)
    <div class="container-fluid mt-2">

    </div>
        @else
        <div class="container mt-5">
            <p class="text-center text-info" style="font-size: 200px">
            <i class="fa fa-share-alt" ></i>
            </p>
            <p class="text-center">Shared Files appear here</p>
            <p class="text-center">
                <a class="btn btn-info " href="{{url('/BrightDrive')}}"><i class="fa fa-angle-left mr-1"></i> Back Home</a>
            </p>

        </div>
    @endif
@endsection