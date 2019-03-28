<div class=" col-lg-12" >
    <div class="border-bottom border-danger container">
        <h6 class="text-center "><small class="text-info">My To-Do</small></h6>
    </div>
</div>
<div class="col-lg-12 mt-2" >
    <!--Button to trigger adding task modal-->
    <button class="btn btn-dark pull-right" data-toggle="modal" data-target="#addtask">Add Task</button>
</div>
<!--Container with all the tasks-->
<div class="container-fluid mt-2" >
    @if($tasksCount >0)

        <table class="table table-light table-hover">
            <tr>
                <th>Title</th>
                <th>Start</th>
                <th>Deadline</th>
            </tr>
            @foreach($tasks as $task)
                <tr>
                    <td><a href="#" data-toggle="modal" data-target="#task{{$task->id}}">{{$task->title}}</a></td>
                    <td>{{$task->start}}</td>
                    <td>{{$task->deadline}}</td>
                </tr>

            @endforeach
        </table>

    @endif
</div>
<!--Modal for launching a task-->
@if($tasksCount >0)
    @foreach($tasks as $task)
        <div class="modal fade" id="task{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="task{{$task->id}}Title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="task{{$task->id}}LongTitle"><small class="text-info">{{$task->title}}</small></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{!! $task->body !!}</p>
                        <p><small class="text-info">Start : {{$task->start}} Deadline : {{$task->deadline}}</small></p>
                        @if(auth()->user()->id == $task->user_id)

                            {!! Form::open(['action' => ['AdminTodoController@destroy', $task->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                            {!! Form::close() !!}
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

<!--Modal for adding admin tasks-->
<div class="modal fade" id="addtask" tabindex="-1" role="dialog" aria-labelledby="addtaskTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-center" id="addtaskTitle"><small class="text-info">Add Task</small></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['action' => 'AdminTodoController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::label('title', 'Title')}}
                    {{Form::text('title', '', ['class' => 'form-control', 'placeholder' =>'Title'])}}
                </div>
                <div class="form-group">
                    {{Form::label('body', 'Body')}}
                    {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' =>'Body text'])}}
                </div>
                <div class="form-group">
                    {{Form::label('start', 'Start date',['class' => 'mr-3'])}}
                    {{Form::date('start')}}
                </div>
                <div class="form-group">
                    {{Form::label('deadline', 'Deadline',['class' => 'mr-3'])}}
                    {{Form::date('deadline')}}
                </div>
                {{Form::submit('Submit', ['class'=>'btn btn-primary '])}}
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


