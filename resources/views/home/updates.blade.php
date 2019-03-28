
<div class="row ">
    @if(count($posts)>0)
        @foreach($posts as $post)
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div  >
            <div >
                <img class="card-img-top" src="/storage/news_images/{{$post->cover_image}}" alt="Card image cap">
            </div>

            <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5>
                <small class="font-italic">Posted on {{$post->created_at}} by {{$post->user->name}}</small>
                <h6 class="card-link"><a href="/posts/{{$post->id}} " data-toggle="modal" data-target="#post{{$post->id}}">
                        VIEW POST<i class="fa fa-angle-right
                                    ml-3 mr-2" style="font-size:20px;"></i> </a>
                </h6>
            </div>
        </div>
    </div>
        @endforeach
    @endif
</div>
@if(count($posts)>0)
    @foreach($posts as $post)
<div class="modal fade" id="post{{$post->id}}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{$post->title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <img class="card-img-top" src="/storage/news_images/{{$post->cover_image}}" alt="Card image cap">
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h1 class="text-center text-info border-bottom border-danger"><small>{{$post->title}}</small></h1>
                        <p><small>{!!$post->body!!}</small></p>
                        <p><small class="font-italic text-info">Created by {{$post->user->name}} on {{$post->created_at}}</small></p>
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
@endif


