@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-5">
  <div class="row">
    <div class="col-12">
      <div class="card border shadow-xs mb-4">
        <div class="card-header border-bottom pb-0">
          <div class="d-sm-flex align-items-center mb-3">
            <div>
              <h6 class="font-weight-semibold text-lg mb-0">Edit Account</h6>
              <p class="text-sm mb-sm-0">Edit the account information</p>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('accounts.update', $user) }}">
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
                  <input type="text" name="email" class="form-control" id="email" value="{{ $user->email }}">
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
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="role">Role</label>
                  <div class="dropdown">
                    <button class="btn btn-white me-2 dropdown-toggle" type="button" id="roleDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span id="selectedRoleText">{{ $user->role }}</span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="roleDropdown">
                      <li><a class="dropdown-item" href="#" onclick="selectRole('administrator')">Administrator</a></li>
                      <li><a class="dropdown-item" href="#" onclick="selectRole('cashier')">Cashier</a></li>
                    </ul>
                    <input type="hidden" name="role" id="selectedRole" value="{{ $user->role }}">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="joining_date">Joining Date</label>
                  <input type="date" name="joining_date" class="form-control" id="joining_date" value="{{ $user->joining_date }}">
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Account</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
