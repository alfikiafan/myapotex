@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-5">
  {{-- if error to edit medicines --}}
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
              <h6 class="font-weight-semibold text-lg mb-0">Edit Medicine</h6>
              <p class="text-sm mb-sm-0">Edit the medicine information</p>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('medicines.update', $medicine) }}">
            @csrf
            @method('PUT')

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Medicine Name</label>
                  <input type="text" name="name" class="form-control" id="name" value="{{ $medicine->name }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="brand">Brand</label>
                  <input type="text" name="brand" class="form-control" id="brand" value="{{ $medicine->brand }}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="category">Category</label>
                  <input type="text" name="category" class="form-control" id="category" value="{{ $medicine->category }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="quantity">Quantity</label>
                  <input type="number" name="quantity" class="form-control" id="quantity" value="{{ $medicine->quantity }}" min="0" step="1" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="discount">Discount (%)</label>
                  <input type="number" name="discount" class="form-control" id="discount" value="{{ $medicine->discount * 100 }}" min="0" step="1" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="price">Price (Rp)</label>
                  <input type="number" name="price" class="form-control" id="price" value="{{ $medicine->price }}" min="0" step="100" required>
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Medicine</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
