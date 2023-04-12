@extends('layouts.admin')

@section('title')
Permission
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Permission</h3>
        <div class="card-tools">
            <a href="{{ route('permission.create') }}"  class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create</a>
        </div>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                <th>No.</th>
                    <th>Name</th>
                    <th>Date Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($permissions as $index => $permission)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->created_at }}</td>
                        <td>
                            <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-sm btn-warning">Edit Permission</a>
                        </td>
                    </tr>
                @empty
                    <tr>No Result Found</tr>
                @endforelse
              
            </tbody>
        </table>
    </div>

</div>
@endsection