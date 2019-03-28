@extends('base')
@section('title')
    BrightDrive
@endsection
@section('content')
    <style type="text/css">
        img{
            max-width: 100%;
            height: auto;
        }
    </style>
    <div class="sticky-top">
        @include('includes.drivenav')
    </div>
    <div class="container-fluid mt-2 border-bottom">
        <h3 class="text-center text-info">BrightDrive : <small><i>Your files under care</i></small></h3>
    </div>
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 row">
                <div class="col-lg-8">
                    <img src="{{ asset ('images/cloud-computing-1990405_1920.png')}}" alt="upload png">
                </div>
                <div class="col-lg-4">
                    <div class="mt-5">
                        <p>Secure your important files by uploading them to our servers.</p>
                        <p>Uploaded files are encrypted with recommended world class algorithms.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 row">
                <div class="col-lg-8">
                    <img src="{{ asset ('images/cloud-computing-1990406_1920.png')}}" alt="download png">
                </div>
                <div class="col-lg-4">
                    <div class="mt-5">
                        <p>Our high speed servers are always ready to deliver your files.</p>
                        <p>Take a look or just click a button to download them </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-2">
        <h4 class="text-center">Join us today</h4>
        <div class=" mt-1 row">
            <div class="col-lg-6">
                <a class="btn btn-primary pull-left " data-toggle="modal" data-target="#free5">Free 5 GB Plan</a>
            </div>
            <div class="col-lg-6">
                <a class="btn btn-success pull-right" data-toggle="modal" data-target="#tb1">Ultimate Plan 1 TB</a>
            </div>
        </div>
        <p class="text-center mt-1">Ensure first you have Bright University Account and logged in</p>
    </div>
    @include('BrightDrive.DriveAccount')
    <hr>
    <div class="container mt-3 border-bottom">
        <h3 class="text-info text-center">Security First</h3>
        <div class="row mb-2">
            <div class="col-lg-8">
                <img src="{{asset('images/security-3994019_1920.jpg')}}">
            </div>
            <div class="col-lg-4">
                <div class="mt-5">
                    <p>The security of your files is our major concerns.BrightDrive is 99.9 % sure about the safety of your
                        files.No need to worry about malware attacks.</p>
                    <p>BrightDrive Team runs a security check over your files to ensure they are secure and free from malware
                        attacks.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3 border-bottom">
        <h3 class="text-info text-center">Accessible from any Device</h3>
        <div class="row mb-2">
            <div class="col-lg-8">
                <img src="{{asset('images/web-3967926_1920.jpg')}}">
            </div>
            <div class="col-lg-4">
                <div class="mt-5">
                    <p>Our servers are optimized to be accessed from any device. Android and Windows phones, Tablets and PCs.</p>
                    <p>The device of your choice is not a limitation for you to access BrightDrive.</p>
                    <p>Join us Today !!!</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-2 mb-2">
        @include('includes.footer')
    </div>
@endsection

