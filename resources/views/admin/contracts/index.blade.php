@extends('adminlte::page')

@section('title', 'All Contracts')

@section('content')

    <x-alert />
    <x-delete />

    <div class="card">
        <div class="card-header border-bottom-0">
            <h3 class="card-title text-bold" style="font-size:1.4rem">All Contracts</h3>
            
            <div class="card-tools">
                <a href="{{ route('admin.contracts.export') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-fw fa-file-excel mr-1"></i>
                    <span>Export Contracts</span>
                </a>
                @can('Admin')
                <a href="{{ route('admin.contracts.create') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-plus-circle mr-1"></i>
                    <span>Add New</span>
                </a>
                @endcan
            </div>
            
        </div>
        <div class="card-body p-0 border-top-0">
            <table class="table table-bordered border-top-0">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contracts as $contract)
                    <tr>
                        <td>{{ $contract->id }}</td>
                        <td>{{ $contract->user->name }}</td>
                        <td>{{ $contract->subject }}</td>
                        <td>{{ $contract->contract_date }}</td>
                        <td>
                            <!-- Show -->
                            <a href="{{ route('admin.contracts.show', $contract->id) }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-fw fa-eye mr-1"></i>
                                <span>Details</span>
                            </a>
                            @can('Admin')
                            <!-- Edit -->
                            <a href="{{ route('admin.contracts.edit', $contract->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-fw fa-edit mr-1"></i>
                                <span>Edit</span>
                            </a>

                            <!-- Delete -->
                            <a href="#" onclick="confirmDelete({{ $contract->id }})" class="btn btn-danger btn-sm">
                                <i class="fas fa-fw fa-edit mr-1"></i>
                                <span>Delete</span>
                            </a>

                            <!-- Delete Form -->
                            <form id="delete-form-{{ $contract->id }}" action="{{ route('admin.contracts.destroy', $contract->id) }}" method="post">
                                @csrf @method('DELETE')
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($contracts->total() >10)
        <div class="card-footer">
            {{ $contracts->links() }}
        </div>
        @endif
    </div>
@stop
