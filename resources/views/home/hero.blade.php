<style type="text/css">
.hero{

    width: 100%;
    height: 500px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: white;
    background-image: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url({{ asset('images/unii3.jpg') }})


}
.hero-inner{
    max-width: 100%;
    height: auto;
}
.hero h1{
    font-size: 5em;
    margin-top: 0;
    margin-bottom: 0.5em;
}
.hero .btn{
    display: block;
    width: 200px;
    padding: 0.5em;
    margin-top: 50px;
    margin-left: auto;
    margin-right: auto;
    color: white;
    text-decoration: none;
    font-size: 1.5em;
    border: 3px solid black;
    border-radius: 15px;

}
</style>
<section class="hero" style="background-size: cover;background-position: center center;
background-repeat: no-repeat;background-attachment:fixed;">
    <div class="hero-inner">
        <h1>Bright University</h1>
        <h2>Fullfilling The Promise</h2>
        <a href="{{url('/about')}}" class="btn btn-info">About Us</a>
    </div>
</section>
