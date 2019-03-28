<!--Free 5 GB-->
<div class="modal fade" id="free5" tabindex="-1" role="dialog" aria-labelledby="free5Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="free5Title"><small class="text-info">Free 5 GB</small></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <p class="text-center text-info"><small>5 GB for you just for free</small></p>

                    @if(!Auth::guest())
                        {!! Form::open(['action' => 'BrightDriveController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
                        <div class="form-group">
                            {{Form::label('profile_picture', 'Profile Picture')}}<br>
                            {{Form::file('profile_picture')}}
                        </div>
                        <input type="hidden" name="plan" value="free5">
                        {{Form::submit('Register', ['class'=>'btn btn-primary mb-1'])}}
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--1 TB-->
<div class="modal fade" id="tb1" tabindex="-1" role="dialog" aria-labelledby="free5Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="free5Title"><small class="text-info">1 Tb Storage for Ksh 6000</small></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <p class="text-center text-info"><small>Get 1 Tb of storage for Ksh 6000 per year</small></p>
                    @if(!Auth::guest())
                        {!! Form::open(['action' => 'BrightDriveController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
                        <div class="form-group">
                            {{Form::label('profile_picture', 'Profile Picture')}}<br>
                            {{Form::file('profile_picture')}}
                        </div>
                        <input type="hidden" name="plan" value="ultimate">
                        {{Form::submit('Register', ['class'=>'btn btn-primary mb-1'])}}
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>