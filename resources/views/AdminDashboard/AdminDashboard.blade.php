@extends('base')
@section('title')
    AdminSite
@endsection

@section('content')

<div class="container-fluid sticky-top mt-2">
    @include('includes.navbar')
</div>
<div class="container-fluid mt-2 ">
    @include('AdminDashboard.SystemStatus')
</div>
<div class="container-fluid mt-2">
    @include('AdminDashboard.glance')
</div>
@endsection
