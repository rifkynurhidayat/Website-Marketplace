@extends('layouts.admin-dashboard')
@section('title')
    Dashboard Admin
@endsection
@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Admin Dashboard</h2>
                <p class="dashboard-subtitle">Look what you have made today!</p>
                <div class="dashboard-content">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="dashboard-card-title">Customer</div>
                                    <div class="dashboard-card-subtitle">{{ $customer }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="dashboard-card-title">Revenue</div>
                                    <div class="dashboard-card-subtitle">{{ $revenue }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="dashboard-card-title">Transaction</div>
                                    <div class="dashboard-card-subtitle">{{ $transaction }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 mt-2">
                            <h5 class="mb-3">Recent Transactions</h5>
                            <a href="/dashboard-transactions-details.html" class="card card-list d-block">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <img src="/images/icon-product-transactions.png" alt="" />
                                        </div>
                                        <div class="col-md-4">Shirup Marzan</div>
                                        <div class="col-md-3">Rifky</div>
                                        <div class="col-md-3">15 July 2002</div>
                                        <div class="col-md-1 d-none d-md-block mt-2">
                                            <img src="/images/transactions-arrow-right.svg" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="/dashboard-transactions-details.html" class="card card-list d-block">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <img src="/images/icon-product-transactions.png" alt="" />
                                        </div>
                                        <div class="col-md-4">Shirup Marzan</div>
                                        <div class="col-md-3">Rifky</div>
                                        <div class="col-md-3">15 July 2002</div>
                                        <div class="col-md-1 d-none d-md-block mt-2">
                                            <img src="/images/transactions-arrow-right.svg" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="/dashboard-transactions-details.html" class="card card-list d-block">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <img src="/images/icon-product-transactions.png" alt="" />
                                        </div>
                                        <div class="col-md-4">Shirup Marzan</div>
                                        <div class="col-md-3">Rifky</div>
                                        <div class="col-md-3">15 July 2002</div>
                                        <div class="col-md-1 d-none d-md-block mt-2">
                                            <img src="/images/transactions-arrow-right.svg" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
