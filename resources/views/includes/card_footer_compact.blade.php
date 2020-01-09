<div class="img_info">
    <div class="img_descripcion">
        <a href="#" class=" btn-link"><span> {{'@' . $image->user->nick }}</span></a>
        {{ $image->description }}
    </div>
    <span class=" text-secondary pl-2"> {{ \CustomTime::longTimeFilter($image->created_at) }}</span>
    <hr>
    <div class="row justify-content-around">
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
        <div class="comment action_item">
            <a href="{{ route('image.detail',['filename'=>$image->id]) }}"
                class="align-content-center text-decoration-none text-muted">
                <i class="far fa-comment-alt"></i>
                <span class="text-black-50 pl-2">Comentar</span>
            </a>
        </div>
        <div class="share action_item">
            <a href="#" class="align-content-center text-decoration-none text-muted">
                <i class="far fa-share-square"></i>
                <span class="text-black-50 pl-2">Compartir</span>
            </a>
        </div>
    </div>
</div>