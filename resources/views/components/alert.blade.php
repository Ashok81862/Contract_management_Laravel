@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <div style="display:flex;align-items:center">
            <i class="fas fa-fw fa-exclamation-circle mr-3" style="font-size: 1.3em"></i>
            <div>{{ $errors->first() }}</div>
        </div>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

    </div>
@endif

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <div style="display:flex;align-items:center">
            <i class="fas fa-fw fa-check-circle mr-3" style="font-size: 1.3em"></i>
            <div>{{ session('success') }}</div>
        </div>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <div style="display:flex;align-items:center">
            <i class="fas fa-fw fa-exclamation-circle mr-3" style="font-size: 1.3em"></i>
            <div>{{ session('error') }}</div>
        </div>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
