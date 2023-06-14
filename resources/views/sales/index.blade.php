@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-5">
      <div class="row">
        <div class="col-12">
          <div class="card border shadow-xs mb-4">
            <div class="card-header border-bottom pb-0">
              <div class="d-sm-flex align-items-center mb-3">
                <div>
                  <h6 class="font-weight-semibold text-lg mb-0">Sales Transaction</h6>
                  <p class="text-sm mb-sm-0">Record and process sales transaction</p>
                </div>
                <div class="ms-auto d-flex">
                  <div class="me-4">
                    <h6 class="font-weight-semibold text-m mb-0">ID Transaction: T0001</h6>
                  </div>
                  <a href="{{ route('medicines.create') }}">
                    <button type="button" class="btn btn-sm btn-white btn-icon d-flex align-items-center mb-0 me-2">
                    <span class="btn-inner--icon me-2">
                      <i class="fa-solid fa-plus" style="color: #000000;"></i>
                    </span>
                      <span class="btn-inner--text">Reset‎ transaction</span>
                    </button>
                  </a>
                  <a href="{{ route('medicines.create') }}">
                    <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0 me-2">
                    <span class="btn-inner--icon me-2">
                      <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                    </span>
                      <span class="btn-inner--text">Add‎ sales</span>
                    </button>
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body px-0 py-0">
              <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                  <thead class="bg-gray-100">
                    <tr>
                      <th class="text-secondary text-xs font-weight-semibold">No.</th>
                      <th class="text-secondary text-xs font-weight-semibold">ID</th>
                      <th class="text-secondary text-xs font-weight-semibold">Medicine Name</th>
                      <th class="text-secondary text-xs font-weight-semibold">Quantity</th>
                      <th class="text-secondary text-xs font-weight-semibold">Price</th>
                      <th class="text-secondary text-xs font-weight-semibold">Discount</th>
                      <th class="text-secondary text-xs font-weight-semibold">Subtotal</th>
                      <th class="text-secondary text-xs font-weight-semibold">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td class="ps-4">
                      <div class="d-flex align-items-center">
                        <a href="">
                          <button type="button" class="btn btn-sm btn-primary mb-0 me-1">
                            <i class="fas fa-pencil-alt"></i>
                          </button>
                        </a>
                        <form action="" method="POST">
                            <button type="submit" class="btn btn-sm mb-0 ms-1 btn-danger" onclick="return confirm('Are you sure to delete this medicine?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endsection