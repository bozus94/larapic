@extends('layouts.app') 
@section('content')
<div class="container home py-4 m-auto">
     <div class="row ">
         <form action="{{ route('persons') }}" method="GET" class="col-md-6" id="search">
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('search') is-invalid @enderror"
                placeholder="Por ejemplo oscar" aria-label="search"
                aria-describedby="basic-addon2" id="search_input">
            <div class="input-group-append">
                <input type="submit" class=" btn btn-outline-secondary" value="Buscar">
            </div>
            @error('search')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </form>
     </div>
    <div class="row row-cols-1 row-cols-md-4">
            @foreach ($users as $user) 
              @include('includes.userView', ['user'=>$user]) 
            @endforeach
    </div>
    <div class="mt-4 d-flex justify-content-center">
        {{$users->links()}}
    </div>
        {{-- Paginacion --}}
</div>
@endsection
