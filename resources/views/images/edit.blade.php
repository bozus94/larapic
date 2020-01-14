@php
if (session('description')) {
var_dump(session('description'));
}
@endphp

@extends('layouts.app')

@section('content')

<div class="container py-4 m-auto">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Editar Imagen
                </div>
                @include('includes.message')
                <div class="card-body row">
                    <div class="container_img col-md-6">
                        <a href="{{ route('image.detail', ['filename' => $image->id]) }}" class="">
                            <img src="{{ route('image.file', ['filename'=> $image->image_path]) }}" alt="">
                        </a>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('image.update' ) }} " method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="image_id" value="{{ $image->id }}">
                            <div class="form-group row">
                                <label for="image_path" class="col-md-3 col-form-label text-md-right">
                                    Imagen
                                </label>
                                <div class="col-md-9">
                                    <div class="custom-file">
                                        <input type="file" name="image_path" id="image_path" class="custom-file-input">
                                        <label for="image_path"
                                            class="custom-file-label @error('image_path') is-invalid @enderror">Seleccionar
                                            archivo</label>
                                        @error('image_path')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- ./ formgroup --}}

                            <div class="form-group row">
                                <label for="description" class="col-md-3 col-form-label text-md-right">Descripcion</label>
                                <div class="col-md-9">
                                    <textarea name="description" id="description"
                                        class="form-control @error('description') is-invalid @enderror  ">{{ $image->description }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                   @enderror
                                </div>

                            </div>
                            {{-- ./ formgroup --}}

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-3">
                                    <input type="submit" value="Editar imagen" class="btn btn-primary">
                                </div>
                                <div class="col-md-6 offset-md-3">
                                   
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- ./ cardbody --}}
            </div>
        </div>
    </div>
</div>

@endsection