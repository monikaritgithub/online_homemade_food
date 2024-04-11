@extends('layouts.adminDashboard')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
     <!-- Include additional head content -->
</head>
<body>
    <div class="container">
        <!-- Analytics Dashboard -->
        <div class="analytics">
            <h1 class="heading">Analytics Dashboard</h1>
            <span class="month-label">Month:
                <select id="monthSelector" class="dropbtn">
                    <option value="allMonths" selected>All Months</option>
                    <option value="january">January</option>
                    <option value="february">February</option>
                </select>
            </span>
        </div>

        <!-- Cards -->
        <div class="cards">
    <div class="card">
        <h2>Total Sales</h2>
        <p class="amount">{{ $totalSales >= 1000 ? number_format($totalSales / 1000, 1) . 'K' : $totalSales }}</p>
        <p class="increment">+10%</p>
    </div>
    <div class="card">
        <h2>Cash</h2>
        <p class="amount">{{ $cashSales >= 1000 ? number_format($cashSales / 1000, 1) . 'K' : $cashSales }}</p>
        <p class="decrement">-5%</p>
    </div>
    <div class="card">
        <h2>Khalti</h2>
        <p class="amount">{{ $khaltiSales >= 1000 ? number_format($khaltiSales / 1000, 1) . 'K' : $khaltiSales }}</p>
        <p class="increment">+15%</p>
    </div>
</div>

        <!-- Recent Sales -->
        <div class="recent-sales cart container">
    <h1 class="heading">Recent Sales<span class="view-details-btn">View Sales in details</span></h1>
    <table class="sales-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Customer Name</th>
                <th>Amount (Rs)</th>
                <th>Payment Method</th>
            </tr>
        </thead>
        <tbody class="scrollable-tbody">
            @php $count = 0; @endphp
            @foreach ($recentSales as $sale)
                <tr @if ($count >= 5) class="hidden-row" @endif>
                    <td>{{ $sale->id }}</td>
                    <td>{{ $sale->food_name }}</td>
                    <td>{{ $sale->customer_name }}</td>
                    <td>{{ $sale->amount }}</td>
                    <td>{{ $sale->payment_method }}</td>
                </tr>
                @php $count++; @endphp
            @endforeach
        </tbody>
    </table>
</div>


        <!-- Top Selling Product -->
        <div class="top-selling-product cart container">
    <h1 class="heading">Top Selling Product</h1>
    <table class="top-selling-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total Amount Generated (Rs)</th>
            </tr>
        </thead>
        <tbody class="scrollable-tbody">
            @php $count = 0; @endphp
            @foreach ($topSellingProducts as $product)
                @if ($count < 5)
                    <tr>
                        <td>{{ $product->food_name }}</td>
                        <td>{{ $product->total_quantity }}</td>
                        <td>{{ $product->total_amount }}</td>
                    </tr>
                @php $count++; @endphp
                @endif
            @endforeach
            @foreach ($topSellingProducts as $product)
                @if ($count >= 5)
                    <tr class="hidden-row">
                        <td>{{ $product->food_name }}</td>
                        <td>{{ $product->total_quantity }}</td>
                        <td>{{ $product->total_amount }}</td>
                    </tr>
                @php $count++; @endphp
                @endif
            @endforeach
        </tbody>
    </table>
</div>

        <!-- Top Selling Chef -->
        <div class="top-selling-chef cart container">
            <h1 class="heading">Top Selling Chef</h1>
            <table class="top-selling-table">
                <thead>
                    <tr>
                        <th>Chef Name</th>
                        <th>Quantity</th>
                        <th>Total Amount Generated</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topSellingChefs as $chef)
                    <tr>
                        <td>{{ $chef->chef_name }}</td>
                        <td>{{ $chef->total_quantity }}</td>
                        <td>{{ $chef->total_amount_generated }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>
@endsection
