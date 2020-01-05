@extends('layouts.app')

@section('content')
<div class="container home">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.message')
            @foreach ($images as $image)
                @include('includes.imageView')     
            @endforeach
            {{-- Paginacion --}}
            <div class="mt-4 d-flex justify-content-center">
                {{$images->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
