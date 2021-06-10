@extends('adminlte::page')

@section('title', 'Update Contract')

@section('plugins.Select2', true)

@push('js')
<script>
    $(document).ready(function() {
        $('#user_id').select2();
    });
</script>
@endpush

@section('content')

    <x-alert />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">Update Contract</h3>
            <div class="card-tools">
                <a href="{{ route('admin.contracts.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.contracts.update', $contract->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="user_id">Client Name</label>
                    <select
                        name="user_id" id="user_id"
                        class="form-control @error('user_id') is-invalid @enderror"
                    >
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" @if($contract->user_id == $user->id) selected @endif>{{ $user->name }}</option>
                        @endforeach
                    </select>

                    @error('name')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Contract Date</label>
                    <input
                        type="date"
                        name="contract_date" id="contract_date"
                        value="{{ old('contract_date') ?? $contract->contract_date }}"
                        class="form-control @error('contract_date') is-invalid @enderror"
                    >
                    @error('contract_date')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input
                        type="text"
                        name="subject" id="subject"
                        value="{{ old('subject') ?? $contract->subject }}"
                        class="form-control @error('subject') is-invalid @enderror"
                    >
                    @error('subject')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="full_text">Description</label>
                    <textarea
                        name="full_text" id="full_text"
                        class="form-control @error('full_text') is-invalid @enderror"
                    >{{ old('full_text') ?? $contract->full_text}}</textarea>
                    @error('full_text')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="is_signed">
                        <input
                            type="checkbox"
                            name="is_signed" id="is_signed"
                            value="1"
                            @if($contract->is_signed) checked @endif
                        >
                        <span class="ml-2">Is Signed?</span>
                    </label>

                    @error('is_signed')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mt-4 mb-1">
                    <input type="submit" class="btn btn-primary" value="Update User">
                    <a href="{{ route('admin.contracts.index') }}" class="btn btn-link float-right">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@stop
