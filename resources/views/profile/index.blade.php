@extends('layouts.app')

@section('content')
  <div class="container-fluid py-4 px-5">
   {{-- if add or edit success --}}
   @if(session('success'))
   <div class="alert alert-success">
     {{ session('success') }}
   </div>
   @endif
    <div class="row">
      <div class="col-12">
        <div class="card border shadow-xs mb-4">
          <div class="card-header border-bottom pb-0">
            <div class="d-sm-flex align-items-center mb-3">
              <div>
                <h6 class="font-weight-semibold text-lg mb-0">User Profile</h6>
                <p class="text-sm mb-sm-0">See information about your profile data</p>
              </div>
            </div>
          </div>
          <div class="card-body px-2 py-2">
           <div class="row d-flex align-items-center justify-content-center mt-4">
            <div class="col-md-4">
             Nama
            </div>
            <div class="col-md-4">
             {{ $user->name }}
            </div>
           </div>
           <div class="row d-flex align-items-center justify-content-center mt-4">
            <div class="col-md-4">
             Email
            </div>
            <div class="col-md-4">
             {{ $user->email }}
            </div>
           </div>
           <div class="row d-flex align-items-center justify-content-center mt-4">
            <div class="col-md-4">
             Joining Date
            </div>
            <div class="col-md-4">
             {{ $user->joining_date }}
            </div>
           </div>
           <div class="d-flex align-items-center justify-content-center mt-5 mb-3">
            <a href="{{ route('profile.edit', $user->id) }}">
             <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0 me-2">
              <span class="btn-inner--icon me-2">
               <i class="fa-solid fa-pencil" style="color: #ffffff;"></i>
              </span>
              <span class="btn-inner--text">Edit Profile</span>
             </button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection