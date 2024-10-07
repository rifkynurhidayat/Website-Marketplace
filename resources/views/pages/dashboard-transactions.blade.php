@extends('layouts.dashboard')
@section('title')
    Store Dashboard Transaction
@endsection
@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title">Transactions</h2>
      <p class="dashboard-subtitle">Big result start from the small one</p>
      <div class="dashboard-content">
        <div class="row">
          <div class="col-12 mt-2">
            <ul class="nav nav-tab mt-2" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Sell Product</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Buy Product</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                @foreach ($transaksiPenjualan as $penjualan)
                <a href="{{ route('dashboard-transaction-details', $penjualan->id) }}" class="card card-list d-block">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-1">
                        <img src="{{ Storage::url($penjualan->product->galleries->first()->photo ?? '') }}" class="w-50" />
                      </div>
                      <div class="col-md-4">{{ $penjualan->product->name }}</div>
                      <div class="col-md-3">{{ $penjualan->product->user->store_name }}</div>
                      <div class="col-md-3">{{ $penjualan->created_at }}</div>
                      <div class="col-md-1 d-none d-md-block mt-2">
                        <img src="/images/transactions-arrow-right.svg" alt="" />
                      </div>
                    </div>
                  </div>
                </a>
                @endforeach
              </div>
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                @foreach ($transaksiPembelian as $pembelian)
                <a href="{{ route('dashboard-transaction-details', $pembelian->id) }}" class="card card-list d-block">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-1">
                        <img src="{{ Storage::url($pembelian->product->galleries->first()->photo ?? '') }}" class="w-50" />
                      </div>
                      <div class="col-md-4">{{ $pembelian->product->name }}</div>
                      <div class="col-md-3">{{ $pembelian->product->user->store_name }}</div>
                      <div class="col-md-3">{{ $pembelian->created_at }}</div>
                      <div class="col-md-1 d-none d-md-block mt-2">
                        <img src="/images/transactions-arrow-right.svg" alt="" />
                      </div>
                    </div>
                  </div>
                </a>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
