<div class="modal fade" id="comment" tabindex="-1" role="dialog" aria-labelledby="commentTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentTitle"><small class="text-info">{{$current_file}}</small></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    @if(!Auth::guest())
                        {!! Form::open(['action' => 'EaCommentsController@store', 'method' => 'POST']) !!}
                        <div class="form-group">
                            {{Form::label('comment', 'Comment')}}
                            {{Form::textarea('comment', '', ['class' => 'form-control'])}}
                        </div>
                        <input type="hidden" name="file" value="{{$current_file}}">
                        {{Form::submit('Submit', ['class'=>'btn btn-primary mb-2'])}}
                        {!! Form::close() !!}
                        @else
                        <h4 class="text-center"><small class="text-info">Login First to comment</small> </h4>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>