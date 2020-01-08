<div class="card publi_image">
    <div class="card-header">
        @if ($image->user->image)
        <div class="container_avatar">
            <img src="{{  route('user.avatar', [
                    'filename' => $image->user->image
                ]) }}" alt="">
        </div>
        @endif
        <div class="data-user">
            <a href="#" class="text-reset text-decoration-none">{{ $image->user->name . ' ' . $image->user->surname }}
                | <span class=" text-secondary"> {{'@' . $image->user->nick }}</span></a>
        </div>
    </div>
    <div class="card-body">
        <div class="container_img_pub">
            @if ($home)
            <a href="{{ route('image.detail',['filename'=>$image->id]) }}"><img src="{{ route('image.file', [
                'filename' => $image->image_path
            ]) }}" alt=""></a>
            @else
            <img src="{{ route('image.file', [
                'filename' => $image->image_path
            ]) }}" alt="">
            @endif
        </div>
    </div>
    <div class="card-footer">
        @if ($home)
        <div class="img_info">
            <div class="img_descripcion">
                <a href="#" class=" btn-link"><span> {{'@' . $image->user->nick }}</span></a>
                {{ $image->description }}
            </div>
            <span class=" text-secondary pl-2"> {{ \CustomTime::longTimeFilter($image->created_at) }}</span>
            <hr>
            <div class="row justify-content-around">
                <div class="likes action_item">
                    @php $isset_like = false @endphp
                    @foreach ($image->likes as $like)
                    @if ($like->user->id == \Auth::user()->id )
                    @php $isset_like = true @endphp
                    @endif
                    @endforeach
                    @if (!$isset_like)
                    <a href=""
                        class="btn_like align-content-center text-decoration-none text-muted rounded py-2 px-5 btn-light"
                        data-id="{{ $image->id }}">
                        <i class="far fa-heart"></i>
                        <span class="text-black-50 pl-2">10k</span>
                    </a>
                    @else
                    <a href=""
                        class="btn_dislike align-content-center text-decoration-none text-muted rounded py-2 px-5 btn-light"
                        data-id="{{ $image->id }}">
                        <i class="fas fa-heart liked"></i>
                        <span class="text-black-50 pl-2">10k</span>
                    </a>
                    @endif
                </div>
                <div class="comment action_item">
                    <a href="{{ route('image.detail',['filename'=>$image->id]) }}"
                        class="align-content-center text-decoration-none text-muted rounded py-2 px-5 btn-light">
                        <i class="far fa-comment-alt"></i>
                        <span class="text-black-50 pl-2">Comentar</span>
                    </a>
                </div>
                <div class="share action_item">
                    <a href="#"
                        class="align-content-center text-decoration-none text-muted rounded py-2 px-5 btn-light">
                        <i class="far fa-share-square"></i>
                        <span class="text-black-50 pl-2">Compartir</span>
                    </a>
                </div>
            </div>
        </div>
        @else
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
                    @php $isset_like = false @endphp
                    @foreach ($image->likes as $like)
                    @if ($like->user->id == \Auth::user()->id )
                    @php $isset_like = true @endphp
                    @endif
                    @endforeach
                    @if (!$isset_like)
                    <a href="" class="btn_like align-content-center text-decoration-none text-muted rounded "
                        data-id="{{ $image->id }}">
                        <i class="far fa-heart"></i>
                        <span class="text-black-50 pl-2">10k</span>
                    </a>
                    @else
                    <a href="" class="btn_dislike align-content-center text-decoration-none text-muted rounded "
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
                    <a href="{{ route('comment.delete', ['comment_id' => $comment->id]) }}"
                        class="delete text-secondary">
                        <i class="fas fa-times"></i>
                    </a>
                    @endif
                </li>
                @endforeach
            </ul>

        </div>
        @endif
    </div>
    {{-- ./card-footer --}}
</div>