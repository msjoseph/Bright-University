
    @if(count($hostels) > 0)
        <div class="row mb-2">
            <div class="col-lg-6">
                <h3 class="pull-left">HOSTELS</h3>
            </div>
            <div class="col-lg-6">
                <a href="{{url('/hostels')}}" class="btn btn-info pull-right">Hostels Page
                    <i class="fa fa-angle-right ml-2" style="font-size: 20px;"></i> </a>
            </div>
        </div>
        <div class="row">
        @foreach($hostels as $hostel)
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div  >
                    <div >
                        <img class="card-img-top" src="/storage/hostel_images/{{$hostel->image}}" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$hostel->name}}</h5>
                        <h6 class="card-text">Rooms remaining: <small class="text-info">{{$hostel->rem_rooms}}</small></h6>
                        <h6 class="card-text">Rent per room: <small class="text-info">Ksh {{$hostel->rent}}</small></h6>
                        <a href="#"  data-toggle="modal" data-target="#hostel{{$hostel->id}}">
                            SEE MORE <i class="fa fa-angle-right ml-3 mr-2" style="font-size:20px;"></i> </a>

                    </div>
                </div>

            </div>

            <!--Hostel Modal-->
            <div class="modal fade" id="hostel{{$hostel->id}}" tabindex="-1" role="dialog" aria-labelledby="hostel{{$hostel->id}}Title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="hostel{{$hostel->id}}LongTitle"><small class="text-info">{{$hostel->name}} Hostel</small></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-4 pull-left">
                                    <img class="card-img-top" src="/storage/hostel_images/{{$hostel->image}}"
                                         alt="Card image cap">
                                    @if($hostel->rem_rooms >0)
                                        <p><small class="text-success">{{$hostel->rem_rooms}} rooms available</small></p>
                                    @else
                                        <p><small class="text-danger">Fully occupied</small></p>
                                    @endif


                                </div>
                                <div class="col-lg-8 pull-right">
                                    <p><small class="text-info">{{$hostel->name}} Hostel</small></p>
                                    <p><small class="text-info">Has {{$hostel->rooms}} rooms</small></p>
                                    <p><small class="text-info">{{$hostel->num_per_room}} students per room</small></p>
                                    <p><small class="text-info">Ksh {{$hostel->rent}} per room per semester</small></p>
                                    <p><small class="text-info">Pay through {{$hostel->bank}}</small></p>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


            @endforeach
        </div>
        @else
        <h3 class="text-info text-center">No hostel found</h3>
    @endif
