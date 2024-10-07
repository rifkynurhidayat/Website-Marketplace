@extends('layouts.dashboard')
@section('title')
    Dashboard Pages
@endsection
@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Dashboard</h2>
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
                                    <div class="dashboard-card-subtitle">Rp. {{ number_format($revenue) }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="dashboard-card-title">Transaction</div>
                                    <div class="dashboard-card-subtitle">{{ number_format($transaction_count) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    {!! $productChart->container() !!}
                                </div>
                            </div>
                        </div>
                        <form method="GET" action="{{ route('dashboard') }}">
                            <label for="startDate" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="startDate" name="startDate">
                            <label for="endDate" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="endDate" name="endDate">
                            <button type="submit" class="btn btn-primary mt-2">Filter</button>
                        </form>
                        
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    {!! $productTerbanyak->container() !!}
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-12 mt-2">
                            <h5 class="mb-3">Recent Transactions</h5>
                            @foreach ($transaction_data as $data)
                                <a href="{{ route('dashboard-transaction-details', $data->id) }}"
                                    class="card card-list d-block">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img src="{{ Storage::url($data->product->galleries->first()->photo ?? '') }}"
                                                    class="w-75" />
                                            </div>
                                            <div class="col-md-4">{{ $data->product->name ?? '' }}</div>
                                            <div class="col-md-3">{{ $data->transaction->user->name ?? '' }}</div>
                                            <div class="col-md-3">{{ $data->created_at ?? '' }}</div>
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

    <script src="{{ $productChart->cdn() }}"></script>
    {{ $productChart->script() }}

    <script src="{{ $productTerbanyak->cdn() }}"></script>
    {{ $productTerbanyak->script() }}
@endsection
