@extends('layouts.app')
@can('admin')
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
                                    <h6 class="font-weight-semibold text-lg mb-0">Sales List</h6>
                                    <p class="text-sm mb-sm-0">See information about all medicine sales by all cashier</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <form action="{{route('sales.index')}}" method="GET" class="me-3">
                                        <div class="input-group input-group-sm ms-auto">
                                              <button class="input-group-text text-body" type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                                     fill="none"
                                                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                  <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                                                </svg>
                                              </button>
                                            <input type="text" class="form-control form-control-sm" name="search"
                                                   value="{{ request('search') }}" placeholder="Search">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead class="bg-gray-100">
                                    <tr>
                                        <th class="text-secondary text-xs font-weight-semibold">Sales ID</th>
                                        <th class="text-secondary text-xs font-weight-semibold">Date</th>
                                        <th class="text-secondary text-xs font-weight-semibold">Cashier</th>
                                        <th class="text-secondary text-xs font-weight-semibold">Total Price</th>
                                        <th class="text-secondary text-xs font-weight-semibold">Status</th>
                                        <th class="text-secondary text-xs font-weight-semibold">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($sales as $sale)
                                        <tr>
                                            <td class="text-xs ps-4">{{ $sale->id }}</td>
                                            <td class="text-xs ps-4">{{ $sale->created_at }}</td>
                                            <td class="text-xs ps-4">{{ $sale->cashier->name }}</td>
                                            <td class="text-xs ps-4">
                                                <div class="d-flex justify-content-between">

                                                    <span>Rp</span>
                                                    <span class="text-end">
                                                        {{ number_format($sale->total, 2, ',', '.') }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="text-xs ps-4">
                                                @if($sale->is_success)
                                                    <div class="badge badge-lg badge-success"><span class="fa fa-check-circle" aria-hidden="true"></span> Success</div>
                                                @else
                                                    <div class="badge badge-lg badge-danger"><span class="fa fa-times-circle" aria-hidden="true"></span> Cancelled</div>
                                                @endif
                                            </td>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <a href="{{ route('sales.show', $sale) }}">
                                                        <button type="button" class="btn btn-sm btn-primary mb-0 me-1">
                                                            <i class="fa-solid fa-eye fa-10x" aria-hidden="true" style="color:#DDD;width: 16px"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="border-top py-3 px-3 d-flex align-items-center">
                                <p class="font-weight-semibold mb-0 text-dark text-sm">Page {{ $sales->currentPage() }}
                                    of {{ $sales->lastPage() }}</p>
                                <div class="ms-auto">
                                    @if ($sales->currentPage() > 1)
                                        <a href="{{ $sales->previousPageUrl() }}" class="btn btn-sm btn-white mb-0">Previous</a>
                                    @endif

                                    @if ($sales->hasMorePages())
                                        <a href="{{ $sales->nextPageUrl() }}" class="btn btn-sm btn-white mb-0">Next</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endcan

@can('cashier')
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
                                <h6 class="font-weight-semibold text-m mb-0">ID Transaction: <span>{{ $newId }}</span></h6>
                            </div>
                            <a href="">
                                <button type="button" id="reset-transaction-btn" class="btn btn-sm btn-white btn-icon d-flex align-items-center mb-0 me-2">
                                    <span class="btn-inner--text">Reset‎ transaction</span>
                                </button>
                            </a>
                            <button type="button" id="add-item-btn" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0 me-2">
                                <span class="btn-inner--icon me-2">
                                    <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                                </span>
                                <span class="btn-inner--text">Add‎ item</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div id="print" class="card-body px-0 py-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="text-secondary text-xs font-weight-semibold">No.</th>
                                    <th class="text-secondary text-xs font-weight-semibold">ID</th>
                                    <th class="text-secondary text-xs font-weight-semibold">Medicine Name</th>
                                    <th class="text-secondary text-xs font-weight-semibold">Quantity</th>
                                    <th class="text-secondary text-xs font-weight-semibold">Discount</th>
                                    <th class="text-secondary text-xs font-weight-semibold">Price</th>
                                    <th class="text-secondary text-xs font-weight-semibold">Subtotal</th>
                                    <th class="text-secondary text-xs font-weight-semibold">Action</th>
                                </tr>
                            </thead>
                            <tbody id="items-container">

                            </tbody>
                            <tr id="new-row" style="display: none;">
                                <td class="ps-4"></td>
                                <td class="medicine-id"></td>
                                <td>
                                    <input type="text" name="medicine_name[]" class="form-control autocomplete-medicine" data-discount="" data-price="" required>
                                </td>
                                <td>
                                    <input type="number" name="quantity[]" class="quantity form-control" min="0" required>
                                </td>
                                <td class="discount"></td>
                                <td class="price text-end"></td>
                                <td class="subtotal text-end"></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger delete-row">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div id="print-2" class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="discount">Discount</label>
                            <input type="number" name="discount" class="form-control" id="discount" value="" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="total">Total</label>
                            <input type="number" name="total" class="form-control" id="total" value="" readonly>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <button type="submit" id="pay-btn" class="btn btn-dark me-2">Pay</button>
                        <button type="button" id="cancel-btn" class="btn btn-secondary me-2">Cancel</button>
                        <button type="button" id="print-btn" class="btn btn-primary" onclick="window.print();return false;">Print Payment Receipt</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="print-3" class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cash">Cash</label>
                            <input type="number" name="cash" class="form-control" id="cash" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="change">Change</label>
                            <input type="number" name="change" class="form-control" id="change" value="" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/sales.js') }}"></script>

@endsection
@endcan
