@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4 px-5">
      <div class="row">
        <div class="col-12">
          <div class="card border shadow-xs mb-4">
            <div class="card-header border-bottom pb-0">
              <div class="d-sm-flex align-items-center mb-3">
                <div>
                  <h6 class="font-weight-semibold text-lg mb-0">Detail Sale List of Transaction for {{ $sale->id }}</h6>
                  <p class="text-sm mb-sm-0">See information about detail of this sale</p>
                </div>
                <div class="ms-auto d-flex">
                  <form action="{{ route('sales.show', $sale) }}" method="GET" class="me-3">
                    <div class="input-group input-group-sm ms-auto">
                      <span class="input-group-text text-body" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                        </svg>
                      </span>
                      <input type="text" class="form-control form-control-sm" name="search" value="{{ request('search') }}" placeholder="Search">
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div id="print" class="card-body px-0 py-0">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead class="bg-gray-100">
                  <tr>
                      <th class="text-secondary text-xs font-weight-semibold">ID</th>
                      <th class="text-secondary text-xs font-weight-semibold">Medicine ID</th>
                      <th class="text-secondary text-xs font-weight-semibold">Medicine Name</th>
                      <th class="text-secondary text-xs font-weight-semibold">Quantity</th>
                      <th class="text-secondary text-xs font-weight-semibold">Price</th>
                      <th class="text-secondary text-xs font-weight-semibold">Discount</th>
                      <th class="text-secondary text-xs font-weight-semibold">Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($detailSales as $detailSale)
                  <tr>
                  <td class="text-xs ps-3">{{ $detailSale->id }}</td>
                  <td class="text-xs ps-3">{{ $detailSale->medicine_id }}</td>
                  <td class="text-xs ps-3">{{ $detailSale->medicine_name }}</td>
                  <td class="text-xs ps-3">{{ $detailSale->quantity }}</td>
                  <td class="text-xs ps-4 text-end d-flex flex-row justify-content-between">
                    <div class="p-2">Rp</div>
                    <div class="p-2 text-end">
                      {{ number_format($detailSale->price, 2, ',', '.') }}
                    </div>
                    <div></div>
                  </td>
                  <td class="text-xs ps-3">{{ number_format($detailSale->discount * 100, 0) }} % </td>
                  <td class="text-xs ps-4 text-end d-flex flex-row justify-content-between">
                    <div class="p-2">Rp</div>
                    <div class="p-2 text-end">
                      {{ number_format($detailSale->subtotal, 2, ',', '.') }}
                    </div>
                    <div></div>
                  </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <div class="border-top py-3 px-3 d-flex align-items-center">
                  <p class="font-weight-semibold mb-0 text-dark text-sm">Page {{ $detailSales->currentPage() }} of {{ $detailSales->lastPage() }}</p>
                  <div class="ms-auto">
                      @if ($detailSales->currentPage() > 1)
                          <a href="{{ $detailSales->previousPageUrl() }}" class="btn btn-sm btn-white mb-0">Previous</a>
                      @endif

                      @if ($detailSales->hasMorePages())
                          <a href="{{ $detailSales->nextPageUrl() }}" class="btn btn-sm btn-white mb-0">Next</a>
                      @endif
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
