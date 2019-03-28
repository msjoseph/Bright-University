<div class="modal fade" id="update{{$file->id}}" tabindex="-1" role="dialog" aria-labelledby="uploadTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadTitle"><small class="text-info">{{$file->file}}</small></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    {!! Form::open(['action' => ['EaUploadController@update', $file->id], 'method' => 'POST',
                    'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        {{Form::label('description', 'Description')}}
                        {{Form::textarea('description', $file->description, ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('privacy', 'Privacy')}}
                        <select class="form-control" name="privacy" id="privacy">
                            <option value="public">Public</option>
                            <option value="private">Private</option>
                        </select>
                    </div>
                    {{Form::hidden('_method', 'PUT')}}
                    <div class="form-group">
                        {{Form::label('filename', 'Update the file or leave it', ['class'=>'text-info'])}}<br>
                        {{Form::file('file')}}
                    </div>
                    {{Form::submit('Update', ['class'=>'btn btn-primary mb-2'])}}
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>