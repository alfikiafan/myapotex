@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4 px-5">
        <div class="row">
            <div class="col-12">
                <div class="card border shadow-xs mb-4">
                    <div class="card-header border-bottom pb-0">
                        <div class="d-sm-flex align-items-center mb-3">
                            <div>
                                <h6 class="font-weight-semibold text-lg mb-0">Dashboard</h6>
                                @can('admin')
                                <p class="text-sm mb-sm-0">Admin Dashboard Page</p>
                                @elsecan('cashier')
                                <p class="text-sm mb-sm-0">Cashier Dashboard Page</p>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 py-0">
                        <div class="py-3 px-3">
                            <div class="card mb-3">
                                <img src="https://source.unsplash.com/600x100?pharmacy" class="card-img-top" alt="Pharmacy">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Welcome to Pharmacy Management System</h5>
                                    <p class="card-text text-center">Your Trusted Partner in Health</p>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center justify-content-center">
                                @can('cashier')
                                    <div class="col-md-3 ml-0 mr-auto">
                                        <div class="card" style="width: 18rem;">
                                            <img src="https://source.unsplash.com/400x80?sales" class="card-img-top"
                                                alt="Medicines">
                                            <div class="card-body">
                                                <h5 class="card-title text-center">Rp{{ number_format($totalSalesToday, 2, ',', '.') }}</h5>
                                                <p class="card-text text-center">Number of Your Transactions</p>
                                                <p class="card-text text-center">Today</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mx-auto">
                                        <div class="card" style="width: 18rem;">
                                            <img src="https://source.unsplash.com/400x80?sales" class="card-img-top"
                                                alt="Medicines">
                                            <div class="card-body">
                                                <h5 class="card-title text-center">Rp{{ number_format($totalSalesThisMonth, 2, ',', '.') }}</h5>
                                                <p class="card-text text-center">Number of Your Transactions</p>
                                                <p class="card-text text-center">This Month</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 ml-auto mr-0">
                                        <div class="card" style="width: 18rem;">
                                            <img src="https://source.unsplash.com/400x80?sales" class="card-img-top"
                                                alt="Medicines">
                                            <div class="card-body">
                                                <h5 class="card-title text-center">Rp{{ number_format($totalSalesThisYear, 2, ',', '.') }}</h5>
                                                <p class="card-text text-center">Number of Your Transactions</p>
                                                <p class="card-text text-center">This Year</p>
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                                @can('admin')
                                    <div class="col-md-3 ml-0 mr-auto">
                                        <div class="card" style="width: 15rem;">
                                            <img src="https://source.unsplash.com/400x80?profit" class="card-img-top"
                                                alt="Medicines">
                                            <div class="card-body">
                                                <h5 class="card-title text-center">Rp{{ number_format($totalSales, 2, ',', '.') }}</h5>
                                                <p class="card-text text-center">Total Income</p>
                                                <p class="card-text text-center">Today</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mx-auto">
                                        <div class="card" style="width: 15rem;">
                                            <img src="https://source.unsplash.com/400x80?medicine" class="card-img-top"
                                                alt="Medicines">
                                            <div class="card-body">
                                                <h5 class="card-title text-center">{{ $totalMedicine }}</h5>
                                                <p class="card-text text-center">Total All Medicines</p>
                                                <p class="card-text text-center">This Moment</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mx-auto">
                                        <div class="card" style="width: 15rem;">
                                            <img src="https://source.unsplash.com/400x80?medicines" class="card-img-top"
                                                alt="Medicines">
                                            <div class="card-body">
                                                <h5 class="card-title text-center">{{ $totalMedicineLessThan10 }}</h5>
                                                @if ($totalMedicineLessThan10 <= 1)
                                                    <p class="card-text text-center">Medicine With Stock</p>
                                                @else
                                                    <p class="card-text text-center">Medicine With Stock</p>
                                                @endif
                                                <p class="card-text text-center">Less Than 10</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mr-0 ml-auto">
                                        <div class="card" style="width: 15rem;">
                                            <img src="https://source.unsplash.com/400x80?employee" class="card-img-top"
                                                alt="Medicines">
                                            <div class="card-body">
                                                <h5 class="card-title text-center">Cashier: {{ $totalCashier }}, Admin: {{ $totalAdmin }}</h5>
                                                <p class="card-text text-center">Number of Employees</p>
                                                <p class="card-text text-center">This Moment</p>
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
