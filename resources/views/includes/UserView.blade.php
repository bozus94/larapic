<div class="col mb-4">
    <div class="card card-persons">
        <div class="card-header">
            <img src="{{ route('user.avatar', ['filename' => $user->image]) }}" class="card-img-top" alt="{{ $user->nick }}">
        </div>
        <div class="card-body text-center">
            <h5 class="card-title">{{ $user->name . ' ' . $user->surname }}</h5>
            <a href="{{ route('user.profile', ['user_name'=> $user->nick]) }}" class="btn btn-primary">Ver Perfil</a>
        </div>
    </div>
</div>      