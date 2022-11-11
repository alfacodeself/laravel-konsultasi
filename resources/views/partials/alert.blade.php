@if (session('success'))
    <div class="alert alert-primary" role="alert">
        <strong>Success!</strong> {{ session('success') }}
    </div>
@elseif (session('warning'))
    <div class="alert alert-warning" role="alert">
        <strong>Warning!</strong> {{ session('warning') }}
    </div>
@elseif (session('error'))
    <div class="alert alert-danger" role="alert">
        <strong>Error!</strong> {{ session('error') }}
    </div>
@endif