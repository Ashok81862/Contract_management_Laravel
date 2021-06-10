@extends('adminlte::page')

@section('title', 'User Details')

@section('content')

    {{-- <x-alert /> --}}

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">User Details</h3>
            <div class="card-tools">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-fw fa-edit mr-1"></i>
                    <span>Edit</span>
                </a>

                <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td>{{ $user->role }}</td>
                </tr>
                <tr>
                    <td>Photo</td>
                    <td>
                        @if($user->media_id)
                            <img src="/storage/{{ $user->media->path }}" height="30px">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $user->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>
@stop
