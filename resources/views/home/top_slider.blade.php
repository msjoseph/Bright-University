<style type="text/css">
    .carousel-item{
        height: 500px;
    }
    .carousel{
        margin-top: 2px;
        height:500px;
    }

</style>

<div id="top_carousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">

        <li data-target="#top_carousel" data-slide-to="0" class="active"></li>
        <li data-target="#top_carousel" data-slide-to="1" ></li>
        <li data-target="#top_carousel" data-slide-to="2" ></li>

    </ol>
    <div class="carousel-inner" style="height: 500px">
        <div class="carousel-item active">
            <img class="image-fluid" src="{{ asset('images/unii1.jpg') }}" alt="image" style="max-width: 100%;height: auto">
            <div class="carousel-caption d-none d-md-block">
                <h1>Bright University : <small>Fulfilling <i>the</i> promise</small></h1>
                <p>Join us today and get quality education and knowledge for the real world</p>
            </div>
        </div>
        <div class="carousel-item ">
            <img class="image-fluid" src="{{ asset('images/unii2.jpg') }}" alt="image" style="max-width: 100%;height: auto">
            <div class="carousel-caption d-none d-md-block">
                <h1>Our Library</h1>
                <p>Bright has modern library to serve all our students and also surrounding community</p>
            </div>
        </div>
        <div class="carousel-item ">
            <img class="image-fluid" src="{{ asset('images/unii3.jpg') }}" alt="image" style="max-width: 100%;height: auto">
            <div class="carousel-caption d-none d-md-block">
                <h1>Accommodations</h1>
                <p>We have world class hostels and hotels to serve all of our students' needs</p>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#top_carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#top_carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
