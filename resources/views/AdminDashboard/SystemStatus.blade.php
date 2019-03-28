<style type="text/css">
    .admin-status{
        border-radius: 25px;
        padding: 4px;
    }
</style>
<div class="row ">
    <div class="col-lg-4 col-sm-6 mt-2">
        <div class="container ">
            <small class="text-white bg-danger admin-status"><a class="text-white" href="#" data-toggle="modal"
                                                                data-target="#calendar">Academics</a></small>
            @foreach($year as $years)
                @foreach($semester as $semesters)
                <small class="text-info">{{$years->academic_year}} sem {{$semesters->semester}}</small>
                @endforeach
            @endforeach

        </div>
        @include('AdminDashboard.academicsModal')
    </div>
    <div class="col-lg-2 col-sm-6 mt-2">
        <div class="container">
            <small class="text-white bg-danger admin-status">USERS</small>
        </div>
    </div>

    <div class="col-lg-2 col-sm-6 mt-2">
        <div class="container">
            <small class="text-white bg-danger admin-status">WARNINGS</small>
        </div>
    </div>
    <div class="col-lg-2 col-sm-6 mt-2">
        <div class="container">
            <small class="text-white bg-danger admin-status" >CHECK OUT</small>
        </div>

    </div>
    <div class="col-lg-2 col-sm-6 mt-2">
        <div class="container">
            <small class="text-white bg-danger admin-status" >SHUTDOWN</small>
        </div>
    </div>
</div>