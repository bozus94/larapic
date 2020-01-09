@extends('layouts.app')

@section('content')
<div class="container">

</div>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($likes as $like)
            @include('includes.imageView', ['image' => $like->image])
            @endforeach
            {{-- Paginacion --}}
            <div class="mt-4 d-flex justify-content-center">
                {{$likes->links()}}
            </div>
        </div>
    </div>
</div>
@endsection