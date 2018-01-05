@if (session('successMessage'))
    <div class="alert alert-success">
        {{ session('successMessage') }}
    </div>
@endif

@if (session('infoMessage'))
    <div class="alert alert-info">
        {{ session('infoMessage') }}
    </div>
@endif

@if (session('warningMessage'))
    <div class="alert alert-warning">
        {{ session('warningMessage') }}
    </div>
@endif

@if (session('errorMessage'))
    <div class="alert alert-danger">
        {{ session('errorMessage') }}
    </div>
@endif
