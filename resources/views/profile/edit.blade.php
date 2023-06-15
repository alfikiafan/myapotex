@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-5">
  {{-- if error to edit edit profile --}}
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
  </div>
  @endif
  <div class="row">
    <div class="col-12">
      <div class="card border shadow-xs mb-4">
        <div class="card-header border-bottom pb-0">
          <div class="d-sm-flex align-items-center mb-3">
            <div>
              <h6 class="font-weight-semibold text-lg mb-0">Edit Profile</h6>
              <p class="text-sm mb-sm-0">Edit the profile user information</p>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('profile.update', $user) }}">
            @csrf
            @method('PUT')

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control" id="password" placeholder="New Password">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="password_confirmation">Confirm Password</label>
                  <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm New Password">
                </div>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-center mt-5 mb-3">
             <button type="submit" class="btn btn-primary">Update Profile</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
