<div class="img_info">
    <div class="img_descripcion">
        <a href="#" class=" btn-link"><span> {{'@' . $image->user->nick }}</span></a>
        {{ $image->description }}
    </div>
    <span class=" text-secondary pl-2">{{ \CustomTime::longTimeFilter($image->created_at) }}</span>
    @include('includes.message')
    <hr>
    <div class="row img_stats_actions">
        <div class="likes action_item">
            {{-- 
                -- se comprueba si el usuario logueado le dio me gusta a la imagen
                -- para renderizar el boton adecuado   
            --}}
            @php $isset_like = false @endphp
            @foreach ($image->likes as $like)
            @if ($like->user->id == \Auth::user()->id )
            @php $isset_like = true @endphp
            @endif
            @endforeach
            @if (!$isset_like)
            {{-- si elusuario no le dio me gusta se carga el boton con la clase lbtn_like --}}
            <a href="" class="btn_like align-content-center text-decoration-none text-muted" data-id="{{ $image->id }}">
                <i class="far fa-heart"></i>
                <span class="text-black-50 pl-2">10k</span>
            </a>
            @else
            {{-- de lo contrario se renderiza el boton con la clase btn_dislike y al elememto i se le agrega la case liked  --}}
            <a href="" class="btn_dislike align-content-center text-decoration-none text-muted"
                data-id="{{ $image->id }}">
                <i class="fas fa-heart liked"></i>
                <span class="text-black-50 pl-2">10k</span>
            </a>
            @endif
        </div>
        <div class="share action_item">
            <a href="#" class="btn_share align-content-center text-muted rounded">
                <i class="far fa-share-square"></i>
                <span class="text-black-50 pl-2">compartir</span>
            </a>
        </div>
    </div>
</div>
<div class="img_comments">
    <div class="new_comment">
        <form action="{{ route('comment.new') }}" method="POST">
            @csrf
            <input type="hidden" name="image_id" value="{{ $image->id }}">
            <div class="input-group mb-3">
                <input type="text" class="form-control @error('comment_content') is-invalid @enderror"
                    placeholder="Añade un comentario" aria-label="Añade un comentario" name="comment_content"
                    aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <input type="submit" class=" btn btn-outline-secondary" value="Enviar">
                </div>
                @error('comment_content')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </form>
    </div>
    <ul class="list_comments list-group list-group-flush ">
        @foreach ($image->comments as $comment)
        <li class="comment list-group-item d-flex justify-content-between">
            <div class="comment_container d-flex flex-row align-content-center">
                <div class="container-avatar">
                    <img src="{{ route('user.avatar', [
                                'filename' => $comment->user->image
                                ]) }}" alt="">
                </div>
                <div class="comment_content">
                    <div>
                        <a href="#"
                            class="btn btn-link text-reset">{{ $comment->user->name . ' ' . $comment->user->surname  }}</a>
                        <span>{{ $comment->content }}</span>
                    </div>
                    <div class="comment_actions ">
                        <a href="#" class="like_comment">Me gusta</a>
                        <a href="#" class="comment_response">Responder</a>
                        <span
                            class="ago text-secondary">{{ strtolower(\CustomTime::longTimeFilterShort($comment->created_at)) }}</span>
                    </div>
                </div>
            </div>
            @if (\Auth::check() && ($comment->user_id == \Auth::user()->id || $comment->image->user_id ==
            \Auth::user()->id))
            <a href="{{ route('comment.delete', ['comment_id' => $comment->id]) }}" class="delete text-secondary">
                <i class="fas fa-times"></i>
            </a>
            @endif
        </li>
        @endforeach
    </ul>

</div>