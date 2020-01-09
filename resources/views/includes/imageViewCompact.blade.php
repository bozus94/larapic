<div class="card publi_image">
    <div class="card-body">
        <div class="container_img_pub">

            <a href="{{ route('image.detail',['filename'=>$image->id]) }}"><img src="{{ route('image.file', [
                'filename' => $image->image_path
            ]) }}" alt=""></a>

        </div>
    </div>
    {{-- ./card-body --}}
</div>