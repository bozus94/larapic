@extends('layouts.app')

@section('content')
<div class="profile">
    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container profile-info">
            <img class="" src="{{ route('user.avatar', ['filename' => \Auth::user()->image])}}" alt="">
            <h3 class="display-5">{{ \Auth::user()->name . ' ' . \Auth::user()->surname }}</h3>

            <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
        </div>
    </div>
    <div class="container py-4">
        @include('includes.message')
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="d-flex justify-content-between flex-wrap">
                    @foreach ($images as $image)
                    @include('includes.imageViewCompact', ['images' => $image] )
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection