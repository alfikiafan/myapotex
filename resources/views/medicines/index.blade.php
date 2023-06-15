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
                  <h6 class="font-weight-semibold text-lg mb-0">Medicine List</h6>
                  <p class="text-sm mb-sm-0">See information about all medicines</p>
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
                    @can('admin')
                      <a href="{{ route('medicines.create') }}">
                        <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0 me-2">
                        <span class="btn-inner--icon me-2">
                          <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                        </span>
                          <span class="btn-inner--text">Add medicine</span>
                        </button>
                      </a>
                    @endcan
                </div>
              </div>
            </div>
            <div class="card-body px-0 py-0">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead class="bg-gray-100">
                    <tr>
                      <th class="text-secondary text-xs font-weight-semibold">ID</th>
                      <th class="text-secondary text-xs font-weight-semibold">Name</th>
                      <th class="text-secondary text-xs font-weight-semibold">Brand</th>
                      <th class="text-secondary text-xs font-weight-semibold">Category</th>
                      <th class="text-secondary text-xs font-weight-semibold">Quantity</th>
                      <th class="text-secondary text-xs font-weight-semibold">Discount</th>
                      <th class="text-secondary text-xs font-weight-semibold">Price</th>
                        @can('admin')
                            <th class="text-secondary text-xs font-weight-semibold">Action</th>
                        @endcan
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($medicines as $medicine)
                  <tr>
                    <td class="text-xs ps-4">{{ $medicine->id }}</td>
                    <td class="text-xs ps-4">{{ $medicine->name }}</td>
                    <td class="text-xs ps-4">{{ $medicine->brand }}</td>
                    <td class="text-xs ps-4">{{ $medicine->category }}</td>
                    <td class="text-xs ps-4">{{ $medicine->quantity }}</td>
                    <td class="text-xs ps-4">{{ number_format($medicine->discount * 100, 0) }}%</td>
                    <td class="text-xs ps-4 text-end d-flex flex-row justify-content-between">
                        <div class="p-2">Rp</div>
                        <div class="p-2 text-end">
                         {{ number_format($medicine->price, 2, ',', '.') }}
                        </div>
                        <div></div>
                    </td>
                      @can('admin')
                        <td class="ps-4">

                          <div class="d-flex align-items-center">
                            <a href="{{ route('medicines.edit', $medicine) }}">
                              <button type="button" class="btn btn-sm btn-primary mb-0 me-1">
                                <i class="fas fa-pencil-alt"></i>
                              </button>
                            </a>
                            <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm mb-0 ms-1 btn-danger" onclick="return confirm('Are you sure to delete this medicine?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                          </div>
                        </td>
                      @endcan
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <div class="border-top py-3 px-3 d-flex align-items-center">
                  <p class="font-weight-semibold mb-0 text-dark text-sm">Page {{ $medicines->currentPage() }} of {{ $medicines->lastPage() }}</p>
                  <div class="ms-auto">
                      @if ($medicines->currentPage() > 1)
                          <a href="{{ $medicines->previousPageUrl() }}" class="btn btn-sm btn-white mb-0">Previous</a>
                      @endif

                      @if ($medicines->hasMorePages())
                          <a href="{{ $medicines->nextPageUrl() }}" class="btn btn-sm btn-white mb-0">Next</a>
                      @endif
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endsection
