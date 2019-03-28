@extends('base')
@section('title')
    Bright university
@endsection

@section('content')
    <div class="sticky-top ">
        @include('includes.navbar')
    </div>
    <div style="height: 500px">
        @include('home.hero')
    </div>
    <main>
    <div class="container-fluid" style="margin-top: 20px;">
        <div class="row mt-2">
            <div class="col-lg-6 ">
                <h3 class="pull-left">Updates</h3>
            </div>
            <div class="col-lg-6 ">
                    <a class="btn bg-info text-white pull-right" href="{{ url('/news') }}">MORE
                        <i class="fa fa-angle-right ml-3" style="font-size:20px;"></i> </a>
            </div>
        </div>

        @include('home.updates')
    </div>

    <div class="container mt-3" >
        <div class="container col-lg-12 border-bottom border-danger mb-2">
            <h3 class="text-center">Upcoming Event</h3>
        </div>
        @include('home.upcoming')
    </div>
    <div class="container-fluid" style="margin-top: 20px;">
        <div class="row ">
            <div class="col-lg-6 mt-2">
                <h3 class="float-left side-desc" >Projects</h3>
            </div>
            <div class="col-lg-6 mt-2">
                <p class="pull-right"><a class="btn bg-info text-white" href="{{ url('/projects') }}">Projects Page
                        <i class="fa fa-angle-right ml-3" style="font-size:20px;"></i> </a> </p>
            </div>
        </div>
        @include('home.projects')
    </div>

    <div class="container-fluid" style="margin-top: 20px">
        @include('home.bottom_slider')
    </div>
</main>
    <div class="container-fluid mb-3" style="margin-top: 20px">
        @include('includes.footer')
    </div>
@endsection
