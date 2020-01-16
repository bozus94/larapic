@extends('layouts.app')

@section('content')
<div class="profile">
    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container profile-info">
            <img class="" src="{{ route('user.avatar', ['filename' => $user->image])}}" alt="">
            <h3 class="display-5">{{$user->name . ' ' .$user->surname }}</h3>

            <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
        </div>
    </div>
    <div class="container py-4">
        @include('includes.message')
       {{--  <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="d-flex justify-content-around justify-content-start flex-wrap">
                   
                </div>
            </div>
        </div> --}}
        <div class="row row-cols-1 row-cols-md-2">
            @foreach ($images as $image)
                @include('includes.imageViewCompact', ['images' => $image] )
            @endforeach
        </div>
    </div>
@endsection