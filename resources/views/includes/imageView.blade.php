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
        @if(Auth::user() && Auth::user()->id == $image->user_id && !$compact)
            <div class="img_actions ml-auto">
                <a href="{{ route('image.edit', ['id' => $image->id]) }}"><i class="fas fa-edit text-muted"></i></a>
                <!-- Button trigger modal -->
                <button type="menu" class=" btn_flat" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="fas fa-times text-muted"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Eliminar imagen</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Si eilimas la imagen no se podra recuperar, estas seguro de eliminarla?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">cancelar</button>
                            <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-danger">Eliminar</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{-- ./card-header --}}
    <div class="card-body">
        <div class="container_img_pub">
            @if ($compact)
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
    {{-- ./card-body --}}
    <div class="card-footer">
        @if ($compact)
        @include('includes.card_footer_compact')
        @else
        @include('includes.card_footer_extended')
        @endif
    </div>
    {{-- ./card-footer --}}
</div>