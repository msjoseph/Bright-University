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
        video{
            max-width: 100%;
            height: auto;
        }
        audio{
            max-width: 100%;
        }
    </style>
    <div class="sticky-top">
        @include('includes.drivenav')
    </div>
    <div class="container-fluid mt-2 border-bottom">
        <h3 class="text-center text-info">BrightDrive</h3>
    </div>
    @if(count($files) > 0)
        <div class="container-fluid mt-2">
            <div class="row">
                @foreach($files as $file)
                    <!--Photos-->
                    @if($file->category == 'photo')
                        <div class="col-lg-3 col-md-6 col-sm-12 mt-1">
                            <div  >
                                <div >
                                    <img  class="card-img-top" src="/storage/BrightDrive/user_{{auth()->user()->id}}/{{$file->filename}}" alt="{{$file->filename}}">
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="text-info"><small>{{$file->filename}}</small></span>
                                        </div>
                                        <div class="col-12">
                                                    <a href="/DriveDownload/{{$file->filename}}" class="btn btn-info pull-left">
                                                        <i class="fa fa-download text-white "></i></a>

                                                    {!! Form::open(['action' => ['FileUploadController@destroy', $file->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                                    {{Form::hidden('_method', 'DELETE')}}
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash  text-white "></i></button>
                                                    {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!--videos-->
                        @if($file->category == 'video')
                            <div class="col-lg-3 col-md-6 col-sm-12 mt-1">
                                <div  >
                                    <div >
                                        <video class="card-img-top" src="/storage/BrightDrive/user_{{auth()->user()->id}}/{{$file->filename}}" controls
                                               loop poster="{{ asset('images/forza.png') }}">{{$file->filename}}</video>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="text-info text-center"><small>{{$file->filename}}</small></p>
                                            </div>
                                            <div class="col-12">
                                                <a href="/DriveDownload/{{$file->filename}}" class="btn btn-info pull-left">
                                                    <i class="fa fa-download text-white "></i></a>
                                                {!! Form::open(['action' => ['FileUploadController@destroy', $file->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash  text-white ml-1"></i></button>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!--Audio-->
                        @if($file->category == 'audio')
                            <div class="col-lg-3 col-md-6 col-sm-12 mt-1">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-center"><small class="text-info">{{$file->filename}}</small> </p>
                                        <p>
                                            <audio controls>
                                                <source src="/storage/BrightDrive/user_{{auth()->user()->id}}/{{$file->filename}}" >
                                            </audio>
                                        </p>
                                        <div >
                                            <a href="/DriveDownload/{{$file->filename}}" class="btn btn-primary pull-left">
                                                <i class="fa fa-download text-white"></i></a>
                                            {!! Form::open(['action' => ['FileUploadController@destroy', $file->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash  text-white"></i></button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                    <!--Documents-->
                        @if($file->category == 'doc')
                            <div class="col-lg-3 col-md-6 col-sm-12 mt-1">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-center"><small class="text-info">{{$file->filename}}</small> </p>
                                        <div >
                                            <a href="/DriveDownload/{{$file->filename}}" class="btn btn-primary pull-left">
                                                <i class="fa fa-download text-white"></i></a>
                                            {!! Form::open(['action' => ['FileUploadController@destroy', $file->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash  text-white"></i></button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                    <!--Programs-->
                        @if($file->category == 'program')
                            <div class="col-lg-3 col-md-6 col-sm-12 mt-1">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-center"><small class="text-info">{{$file->filename}}</small> </p>
                                        <div >
                                            <a href="/DriveDownload/{{$file->filename}}" class="btn btn-primary pull-left">
                                                <i class="fa fa-download text-white"></i></a>
                                            {!! Form::open(['action' => ['FileUploadController@destroy', $file->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash  text-white"></i></button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                    <!--Compressed-->
                        @if($file->category == 'compressed')
                            <div class="col-lg-3 col-md-6 col-sm-12 mt-1">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-center"><small class="text-info">{{$file->filename}}</small> </p>
                                        <div >
                                            <a href="/DriveDownload/{{$file->filename}}" class="btn btn-primary pull-left">
                                                <i class="fa fa-download text-white"></i></a>
                                            {!! Form::open(['action' => ['FileUploadController@destroy', $file->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash  text-white"></i></button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                    <!--Others-->
                        @if($file->category == 'others')
                            <div class="col-lg-3 col-md-6 col-sm-12 mt-1">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-center"><small class="text-info">{{$file->filename}}</small> </p>
                                        <div >
                                            <a href="/DriveDownload/{{$file->filename}}" class="btn btn-primary pull-left">
                                                <i class="fa fa-download text-white"></i></a>
                                            {!! Form::open(['action' => ['FileUploadController@destroy', $file->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash  text-white"></i></button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif

                    @endforeach
            </div>

        </div>

        @else
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4">

                </div>
                <div class="col-lg-4">
                    <img class="mb-1" src="{{ asset ('images/cloud-computing-1990405_1920.png')}}" alt="Photo">
                    <p class="text-center" >Upload files to see them here</p>
                </div>
                <div class="col-lg-4">

                </div>
            </div>
        </div>
    @endif
    <div class="container-fluid mt-2 mb-2">
        @include('includes.footer')
    </div>

@endsection