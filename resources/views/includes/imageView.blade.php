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