@extends('layouts.admin')
@section('title')
Update User
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <!-- Horizontal Form -->
        <div class="card ">
        

          <div class="card-header">
        <h3 class="card-title">User Infomation - {{ $user->name}}</h3>
        <div class="card-tools">
            <a href="{{route('users.index')}}"  class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
    </div>

          <div class="card-body">
          <form action="{{ route('users.update', $user)}}" method="POST">
            <div class="form-group row">
              <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>
  
              <div class="col-md-6">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>
  
                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>
           
            <div class="form-group row">
              <label for="email" class="col-md-2 col-form-label text-md-right">Email</label>

              <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>

            @csrf
            {{ method_field('PUT')}}
            <div class="form-group row">
              <label for="roles" class="col-md-2 col-form-label text-md-right">Roles</label>
              <div class="col-md-6">
            @foreach($roles as $role)
                  <div class="form-checkbox">
                  <input type="checkbox" name="roles[]" value="{{ $role->id}}"
                  @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                  <label for="userrole">{{ $role->name}}</label>
                  </div>
              
            @endforeach
              </div>
            </div>  
            <div class="form-group row">
              <label for="password" class="col-md-2 col-form-label text-md-right">Change Password</label>
  
              <div class="col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password" required autofocus>
  
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
              </div>
          </div>

              <div class="form-group row">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-success">Update</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection
