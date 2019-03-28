<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Monoton' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Fjalla One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Nobile' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Pontano Sans' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Yantramanav' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Yatra One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Allerta' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Archivo' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Archivo Narrow' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Chakra Petch' rel='stylesheet'>
     <link href='https://fonts.googleapis.com/css?family=Homenaje' rel='stylesheet'>
     <link href='https://fonts.googleapis.com/css?family=Michroma' rel='stylesheet'>
     <link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/stars.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />
    <link rel="stylesheet" href="{{ asset('css/cards-gallery.css') }}" >
    <link rel="stylesheet" href="{{ asset('css/grid-gallery.css') }}" >
    <link rel="stylesheet" href="{{ asset('css/compact-gallery.css') }}" >


    @yield('stylesheets')

</head>
<body class="bg-light">

<div class="container-fluid">
    @include('includes.messages')
</div>

<div >
    @yield('content')
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="{{ asset('js/calendar.js') }}"></script>
<script>
    CKEDITOR.replace( 'article-ckeditor' );
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
<script>
    baguetteBox.run('.cards-gallery', { animation: 'slideIn'});
</script>
<script>
    baguetteBox.run('.grid-gallery', { animation: 'slideIn'});
</script>
<script>
    baguetteBox.run('.compact-gallery', { animation: 'slideIn'});
</script>

</body>
</html>
