@extends('layouts.adminDashboard')
@section('content')

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering Dashboard</title>
    <link rel="stylesheet" href="{{asset('css/admin/dashboard.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  </head>

  <body>
    <div class="container">
      
    <!-- Analytics Dashboard -->
    <div class="analytics">
      <h1 class="heading">Analytics Dashboard </h1><span class="month-label">Month: <select id="monthSelector"
          class="dropbtn">
          <option value="allMonths" selected>All Months</option> <!-- Default selected option -->
          <option value="january">January</option>
          <option value="february">February</option>
          <!-- Add other months here -->
        </select></span>
   

    </div>


    </h1>
    <div class="cards">
      <div class="card">
        <h2>Total Sales</h2>
        <p class="amount">500</p>
        <p class="increment">+10%</p>
      </div>
      <div class="card">
        <h2>Cash</h2>
        <p class="amount">300K</p>
        <p class="decrement">-5%</p>
      </div>
      <div class="card">
        <h2>Khalti</h2>
        <p class="amount">200K</p>
        <p class="increment">+15%</p>
      </div>
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
            <th>Amount</th>
            <th>Payment Method</th>
          </tr>
        </thead>
        <tbody>
          <!-- Rows will be dynamically added via JavaScript -->
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
            <th>Total Amount Generated</th>
          </tr>
        </thead>
        <tbody>
          <!-- Rows will be dynamically added via JavaScript -->
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
          <!-- Rows will be dynamically added via JavaScript -->
        </tbody>
      </table>
    </div>
    </div>

    </div>
    <script src="scripts.js"></script>
  </body>

</html>


@endsection