@extends('layouts.app')


@section('content')
<div class="row">
        <div class="col-12">
          <div class="card border shadow-xs mb-4">
            <div class="card-header border-bottom pb-0">
              <div class="d-sm-flex align-items-center mb-3">
                <div>
                  <h6 class="font-weight-semibold text-lg mb-0">Sale Transaction</h6>
                  <p class="text-sm mb-sm-0">Record and process sales transaction</p>
                 </div>

                 <div class="ms-auto d-flex"> 
                  <form action="{{ route('medicines.index') }}" method="GET" class="me-3">
                    <div class="input-group input-group-sm ms-auto">
                      <span class="input-group-text text-body" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                        </svg>
                      </span>
                      <input type="text" class="form-control form-control-sm" name="search" value="{{ request('search') }}" placeholder="Search">
                    </div> 

                    </form>
                  <a href="{{ route('medicines.create') }}">
                    <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0 me-2">
                    <span class="btn-inner--icon me-2">
                      <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                    </span>
                      <span class="btn-inner--text">Add‎ Transaction</span>
                    </button>
                  </a>
                </div>
              </div>
    @endsection