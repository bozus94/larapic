@if (session('message'))
    <div class="alert alert-success text-center" role="alert">
        {{ session('message') }}
    </div>
@endif