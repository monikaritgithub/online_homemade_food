<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Sales
        $totalSales = DB::table('order_items')->where('payment_status', 'paid')->sum(DB::raw('price * quantity'));

        // Monthly Sales Breakdown
        $cashSales = DB::table('order_items')->where('payment_method', 'Cash')->where('payment_status', 'paid')->sum(DB::raw('price * quantity'));
        $khaltiSales = DB::table('order_items')->where('payment_method', 'Khalti')->where('payment_status', 'paid')->sum(DB::raw('price * quantity'));

        // Recent Sales
        $recentSales = DB::table('order_items')
        ->join('products', 'order_items.food_id', '=', 'products.id')
        ->join('users', 'order_items.customer_id', '=', 'users.id') // Join the users table to get customer name
        ->select('order_items.id', 'products.food_name', 'users.name AS customer_name', DB::raw('price * quantity AS amount'), 'order_items.payment_method')
        ->orderByDesc('order_items.created_at')
        ->limit(10)
        ->get();
    

        // Top Selling Products
        $topSellingProducts = DB::table('order_items')
            ->join('products', 'order_items.food_id', '=', 'products.id')
            ->select('products.food_name', DB::raw('SUM(order_items.quantity) AS total_quantity'), DB::raw('SUM(order_items.price * order_items.quantity) AS total_amount'))
            ->groupBy('products.food_name')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        // Top Selling Chefs
        $topSellingChefs = DB::table('order_items')
            ->join('users', 'order_items.chef_id', '=', 'users.id')
            ->select('users.name AS chef_name', DB::raw('SUM(order_items.quantity) AS total_quantity'), DB::raw('SUM(order_items.price * order_items.quantity) AS total_amount_generated'))
            ->groupBy('users.name')
            ->orderByDesc('total_amount_generated')
            ->limit(5)
            ->get();

        return view('admin.adminDashboard', compact('totalSales', 'cashSales', 'khaltiSales', 'recentSales', 'topSellingProducts', 'topSellingChefs'));
    }
}
