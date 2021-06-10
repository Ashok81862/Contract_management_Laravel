@extends('adminlte::page')

@section('title', 'Contract Details')

@section('content')

    <x-alert />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">Contract Details</h3>
            <div class="card-tools">
                @can('Admin')
                <a href="{{ route('admin.contracts.edit', $contract->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-fw fa-edit mr-1"></i>
                    <span>Edit</span>
                </a>
                @endcan

                <a href="{{ route('admin.contracts.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>{{ $contract->id }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $contract->user->name }}</td>
                </tr>
                <tr>
                    <td>Contract Date</td>
                    <td>{{ $contract->contract_date }}</td>
                </tr>
                <tr>
                    <td>Subject</td>
                    <td>{{ $contract->subject }}</td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>{{ $contract->full_text }}</td>
                </tr>
                <tr>
                    <td>Is Signed ? </td>
                    <td>{{ $contract->is_signed ? "Yes" : "No" }}</td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $contract->created_at }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $contract->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>
@stop
