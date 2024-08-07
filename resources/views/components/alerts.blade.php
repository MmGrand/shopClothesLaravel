@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
        {{ Session::get('success') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
        {{ Session::get('error') }}
    </div>
@endif

@if (Session::has('warning'))
    <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
        {{ Session::get('warning') }}
    </div>
@endif

@if (Session::has('info'))
    <div class="alert alert-info alert-dismissible fade show mt-4" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
        {{ Session::get('info') }}
    </div>
@endif
