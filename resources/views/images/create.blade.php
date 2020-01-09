@php
if (session('description')) {
var_dump(session('description'));
}
@endphp

@extends('layouts.app')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Subir Imagen
                </div>

                <div class="card-body">
                    <form action="{{ route('image.upload' ) }} " method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="image_path" class="col-md-3 col-form-label text-md-right">
                                Imagen
                            </label>
                            <div class="col-md-7">
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
                            <div class="col-md-7">
                                <textarea name="description" id="description"
                                    class="form-control @error('description') is-invalid @enderror">{{old('description')}}</textarea>
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
                                <input type="submit" value="Subir imagen" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
                {{-- ./ cardbody --}}
            </div>
        </div>
    </div>
</div>

@endsection