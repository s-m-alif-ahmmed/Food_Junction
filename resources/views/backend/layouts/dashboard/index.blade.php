@extends('backend.app')

@section('title', 'Dashboard')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Dashboard</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}


    <div class="row">
        {{-- Total Users Card --}}
        <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
            <a href="{{ route('user.index') }}" class="card-link">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-2 fw-semibold">{{ $users_count }}</h3>
                                <p class="text-muted fs-13 mb-0">Total Users</p>
                            </div>
                            <div class="col col-auto top-icn dash">
                                <div class="counter-icon bg-info dash ms-auto box-shadow-info">
                                    <i class="fe fe-users text-white fs-18"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Total Orders Card --}}
        <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
            <a href="{{ route('orders.index') }}" class="card-link">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-2 fw-semibold">{{ $total_orders }}</h3>
                                <p class="text-muted fs-13 mb-0">Total Orders</p>
                            </div>
                            <div class="col col-auto top-icn dash">
                                <div class="counter-icon bg-primary dash ms-auto box-shadow-primary">
                                    <i class="fe fe-shopping-cart text-white fs-18"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Total Revenue Card --}}
        <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 fw-semibold">৳{{ number_format($total_revenue, 2) }}</h3>
                            <p class="text-muted fs-13 mb-0">Total Revenue</p>
                        </div>
                        <div class="col col-auto top-icn dash">
                            <div class="counter-icon bg-success dash ms-auto box-shadow-success">
                                <i class="fe fe-dollar-sign text-white fs-18"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pending Orders Card --}}
        <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
            <a href="{{ route('orders.index', ['status' => 'pending']) }}" class="card-link">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-2 fw-semibold">{{ $pending_orders }}</h3>
                                <p class="text-muted fs-13 mb-0">Pending Orders</p>
                            </div>
                            <div class="col col-auto top-icn dash">
                                <div class="counter-icon bg-warning dash ms-auto box-shadow-warning">
                                    <i class="fe fe-clock text-white fs-18"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        {{-- Recent Orders Table --}}
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Recent Orders</h3>
                    <a href="{{ route('orders.index') }}" class="btn btn-primary btn-sm">View All</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_orders as $order)
                                <tr>
                                    <td>#{{ $order->tracking_id }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>৳{{ number_format($order->final_total, 2) }}</td>
                                    <td>
                                        @if($order->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($order->status == 'complete')
                                            <span class="badge bg-success">Complete</span>
                                        @elseif($order->status == 'canceled')
                                            <span class="badge bg-danger">Canceled</span>
                                        @else
                                            <span class="badge bg-info">{{ ucfirst($order->status) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $order->created_at->format('d M, Y') }}</td>
                                    <td>
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">
                                            <i class="fe fe-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
