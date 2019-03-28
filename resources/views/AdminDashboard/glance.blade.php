<div class=" col-lg-12 " >
    <div class="border-bottom border-danger container">
        <h6 class="text-center "><small class="text-info">At Glance</small></h6>
    </div>
</div>
<ul class="nav nav-tabs mt-2">
    <li class="nav-item">
        <a class="nav-link active" href="#" data-toggle="collapse" data-target="#students" aria-expanded="true"
           aria-controls="students">Students</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#todo" aria-expanded="false"
           aria-controls="todo">Tasks<small class="text-danger ml-2">{{$tasksCount}}</small> </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
    </li>
    <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
    </li>
</ul>
<div class="container-fluid mt-2" id="accordion">
    <div id="students" class="collapse show"  data-parent="#accordion">
        <div class="card-body row">
           @include('AdminDashboard.students')
        </div>
    </div>
    <div id="todo" class="collapse "  data-parent="#accordion">
        <div class="card-body row">
            @include('AdminDashboard.todo')
        </div>
    </div>
</div>

