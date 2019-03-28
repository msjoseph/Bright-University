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
            <img class="image-fluid" src="{{ asset('images/oncampus.jpg') }}" alt="image" style="max-width: 100%;height: auto">
            <div class="carousel-caption d-none d-md-block">
                <h1>Discuss Matter Affecting You</h1>
                <p>The University has a Debate club where students get to discuss matters affecting them</p>
            </div>
        </div>
        <div class="carousel-item ">
            <img class="image-fluid" src="{{ asset('images/vacation.jpg') }}" alt="image" style="max-width: 100%;height: auto">
            <div class="carousel-caption d-none d-md-block">
                <h1>Summer Vacation</h1>
                <p>Buy more stationary from our library and stand a chance to win a free summer vacation.</p>
            </div>
        </div>
        <div class="carousel-item ">
            <img class="image-fluid" src="{{ asset('images/google.jpg') }}" alt="image" style="max-width: 100%;height: auto">
            <div class="carousel-caption d-none d-md-block">
                <h1>Programmers</h1>
                <p>Come up with a project and stand a chance for a 1 week trip to Google.</p>
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
