@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.message')
            @foreach ($images as $image)
            <div class="card publi-image mt-4">
                <div class="card-header">
                    @if ($image->user->image)
                        <div class="container_avatar">
                            <img src="{{  route('user.avatar', [
                                'filename' => $image->user->image
                            ]) }}" alt="">
                        </div>
                    @endif
                    <div class="data-user">
                        {{ $image->user->name . ' ' . $image->user->surname }}
                        <span> | {{'@' . $image->user->nick }}</span>
                    </div>
                </div>
                <div class="card-body">
                   <div class="container_img_pub">
                    <img src="{{ route('image.file', [
                        'filename' => $image->image_path
                    ]) }}" alt="">
                   </div>
                </div>
                <div class="card-footer">
                    <div class="img_info">
                        <div class="likes">

                        </div>
                        <div class="descripcion .card-text">
                            <span> {{'@' . $image->user->nick }}</span>
                            {{ $image->description }}
                        </div>
                    </div>
                    <div class="img_comments mt-3">
                        <div class="new_comment">
                            <form action="#">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                      <input type="submit" class=" btn btn-outline-secondary " value="Enviar">
                                    </div>
                                  </div>
                            </form>
                        </div>
                        <ul class="list-comments list-group list-group-flush">
                            <li class="list-group-item"><a href="#" class="btn btn-link">usuario</a> <span>Cras justo odio</span> </li>
                            <li class="list-group-item"><a href="#" class="btn btn-link">usuario</a> <span>Dapibus ac facilisis in</span></li>
                            <li class="list-group-item text-center"><a href="#" class="btn btn-light">ver todos los comentarios</a></li>
                          </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
