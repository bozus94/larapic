@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Fluid jumbotron</h1>
        <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
    </div>
</div>


<div class="container py-4 profile">
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