@extends('home')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between">
    <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>
    <div class="col-md-6">
        <div class="time-filter bg-light rounded-pill d-flex justify-content-between p-1">
            <button class="btn rounded-pill px-4 active">Today</button>
            <button class="btn rounded-pill px-4">This Week</button>
            <button class="btn rounded-pill px-4">This Month</button>
            <button class="btn rounded-pill px-4">This Year</button>
        </div>
    </div>
</div>
<div class="container py-4">
        {{-- <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="fw-bold">Manager Dashboard</h1>
            </div>
            <div class="col-md-6">
                <div class="time-filter bg-light rounded-pill d-flex justify-content-between p-1">
                    <button class="btn btn-warning rounded-pill px-4 active">Today</button>
                    <button class="btn rounded-pill px-4">This Week</button>
                    <button class="btn rounded-pill px-4">This Month</button>
                    <button class="btn rounded-pill px-4">This Year</button>
                </div>
            </div>
        </div> --}}

        <div class="row mb-4">
            <!-- Total Income Card -->
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-2">Total Income</h5>
                        <div class="chart-container">
                            <canvas id="incomeChart"></canvas>
                            <div class="chart-center-text">
                                <span class="fw-bold">$20,000</span>
                            </div>
                        </div>
                        <div class="chart-legend d-flex justify-content-between mt-2 mx-5">
                            <div class="legend-item">
                                <span class="legend-color" style="background-color: #FFA500;"></span>
                                <span>Clothes</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color" style="background-color: #000;"></span>
                                <span>Shoes</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color" style="background-color: #E0E0E0;"></span>
                                <span>Dress</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Balance Card -->
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-2">Total Balance</h5>
                        <h2 class="text-success fw-bold mb-4 text-center">$30,000</h2>
                        
                        <div class="balance-item d-flex align-items-center mb-5 mx-5">
                            <div class="balance-icon bg-dark text-white rounded-circle me-3">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-0">Total Income</h6>
                                <h5 class="mb-0">$4,000</h5>
                            </div>
                            <div class="text-muted">(+ 20% Increase)</div>
                        </div>
                        
                        <div class="balance-item d-flex align-items-center mx-5">
                            <div class="balance-icon bg-warning text-white rounded-circle me-3">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-0">Total Expense</h6>
                                <h5 class="mb-0">$2,000</h5>
                            </div>
                            <div class="text-muted">(+ 30% Increase)</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Daily Selling Chart -->
            <div class="col-md-8 mb-md-0">
                <div class="card h-100   border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-2">Daily Selling</h5>
                        <div class="chart-container-line">
                            <canvas id="dailySellingChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Best Sale Card -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-2">Best Sale</h5>
                        <div class="d-flex justify-content-between mb-3">
                            <div class="fw-bold">Item</div>
                            <div class="fw-bold">Sale</div>
                        </div>
                        
                        <div class="best-sale-item d-flex align-items-center mb-3">
                            <img src="https://via.placeholder.com/40" class="rounded me-2" alt="Ice Latte">
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Jean</h6>
                                <div class="text-warning">$10.00</div>
                            </div>
                            <div class="fw-bold">390</div>
                        </div>
                        
                        <div class="best-sale-item d-flex align-items-center mb-3">
                            <img src="https://via.placeholder.com/40" class="rounded me-2" alt="Ice Cappucino">
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Shoe</h6>
                                <div class="text-warning">$16.00</div>
                            </div>
                            <div class="fw-bold">278</div>
                        </div>
                        
                        <div class="best-sale-item d-flex align-items-center mb-3">
                            <img src="https://via.placeholder.com/40" class="rounded me-2" alt="Ice Latte">
                            <div class="flex-grow-1">
                                <h6 class="mb-0">T-Shirt</h6>
                                <div class="text-warning">$12.00</div>
                            </div>
                            <div class="fw-bold">490</div>
                        </div>
                        
                        <div class="best-sale-item d-flex align-items-center">
                            <img src="https://via.placeholder.com/40" class="rounded me-2" alt="Ice Cappucino">
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Shoe</h6>
                                <div class="text-warning">$20.00</div>
                            </div>
                            <div class="fw-bold">346</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection