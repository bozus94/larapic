@if(Auth::user()->image)
    <div class="container_avatar">
        <img src="{{ route('user.avatar', ['filename' => Auth::user()->image]) }}" alt="avatar">
    </div>
@endif