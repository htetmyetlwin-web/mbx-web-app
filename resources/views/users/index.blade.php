@extends('layouts.admin')

@section('title')
Users
@endsection


@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Users</h3>
        <!-- <a href="{{ route('users.create')}}" > <button type="button" class="btn btn-primary btn-sm float-left"><i class="fas fa-edit"></i></button></a> -->
        <div class="card-tools">
            <a href="{{ route('users.create')}}"  class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create</a>
        </div>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                <th>No.</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Roles</th>
                  <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $index => $user)
                <tr>
                <td>{{ $index + 1}}</td>
                  <td>{{ $user->name}}</td>
                  <td>{{ $user->email}}</td>
                  <td>{{ implode(',', $user->roles()->get()->pluck('name')->toArray())}}</td>
                  <td>
                    @can('edit.users')
                    <a href="{{ route('users.edit', $user->id)}}" > <button type="button" class="btn btn-primary btn-sm float-left"><i class="fas fa-edit"></i></button></a>
                  @endcan
                  @can('delete.users')
                  <form action="{{ route('users.destroy', $user)}}" method="POST" class="float-left">
                  @csrf
                  {{ method_field('DELETE')}}
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                </form>
                @endcan
                  </td> 
                </tr>
                @endforeach
           
              
            </tbody>
        </table>
    </div>

</div>
@endsection
