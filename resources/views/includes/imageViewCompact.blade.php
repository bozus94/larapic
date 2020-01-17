<div class="col">
    <div class="card mb-4">
        <a href="{{ route('image.detail',['filename'=>$image->id]) }}"><img src="{{ route('image.file', [
            'filename' => $image->image_path
        ]) }}" alt="" class="card-img-top mh-230 scale-hover"></a>
    </div>
</div>