@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4 px-5">
  <div class="row">
    <div class="col-12">
      <div class="card border shadow-xs mb-4">
        <div class="card-header border-bottom pb-0">
          <div class="d-sm-flex align-items-center mb-3">
            <div>
              <h6 class="font-weight-semibold text-lg mb-0">Add Medicine</h6>
              <p class="text-sm mb-sm-0">Add a new medicine to the list</p>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('medicines.store') }}">
            @csrf

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Medicine Name</label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="Medicine Name">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="brand">Brand</label>
                  <input type="text" name="brand" class="form-control" id="brand" placeholder="Brand">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="category">Category</label>
                  <input type="text" name="category" class="form-control" id="category" placeholder="Category">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="quantity">Quantity</label>
                  <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Quantity">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="discount">Discount (%)</label>
                  <input type="number" name="discount" class="form-control" id="discount" placeholder="Discount" step="0.01">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="price">Price</label>
                  <input type="number" name="price" class="form-control" id="price" placeholder="Price">
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary">Add Medicine</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
