@extends('base')
@section('title')
    BrightDrive | Upload
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
    <div class="container mt-2">
        <p class="text-center"><a href="{{url('/BrightDrive')}}" class="btn btn-info">
                <i class="fa fa-angle-left mr-1" ></i>Back Home</a></p>
    </div>
    <div class="container">
        <div class="container-fluid row">
            <div class="col-lg-4">

            </div>
            <div class="col-lg-4">
                <img src="{{ asset ('images/cloud-computing-1990405_1920.png')}}" alt="upload png">
                <p class="text-center mt-2"><button class="btn btn-success" data-toggle="modal"
                                                    data-target="#upload">Click Here</button> </p>
            </div>
            <div class="col-lg-4">

            </div>
        </div>
    </div>
    <!--Upload Modal-->
    <div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="uploadTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadTitle"><small class="text-info">File Choose</small></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <div class="container mt-4 row">
                       <div class="col-lg-2">

                       </div>
                       <div class="col-lg-8">
                           {!! Form::open(['action' => 'FileUploadController@store', 'method' => 'POST',
                           'enctype' => 'multipart/form-data', 'files' => true]) !!}
                           <div class="form-group">
                               {{Form::label('filename', 'Choose Files to Upload')}}<br>
                               {{Form::file('filename[]', ['multiple'])}}
                           </div>
                           {{Form::submit('Upload', ['class'=>'btn btn-primary mb-2'])}}
                           {!! Form::close() !!}
                       </div>
                       <div class="col-lg-2">

                       </div>

                   </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection