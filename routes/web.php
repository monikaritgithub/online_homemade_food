<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductReviewController;

use App\Http\Controllers\PaymentController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user(); // Get the authenticated user

        if ($user->role === 0) {
            return redirect('/admin/adminDashboard');
        } elseif ($user->role === 1) {
            return redirect('/customer/view-product-location');
                } else {
            // Handle other roles or cases as needed
            // You might want to return an error view or redirect to another page.
        }
    })->name('dashboard');
});




Route::resource('products', ProductController::class);

Route::get('/admin/adminDashboard', [DashboardController::class, 'index'])->name('analytics');

// Route::post('/admin/add-product', 'ProductController@store')->name('admin.addProduct');
Route::get('/admin/add-product', [ProductController::class, 'create'])->name('admin.addProduct');
Route::post('/admin/add-product', [ProductController::class, 'store'])->name('admin.storeProduct');
Route::get('/admin/view-product', [ProductController::class, 'index'])->name('admin.viewProduct');
Route::get('/admin/edit-product/{id}', [ProductController::class, 'edit'])->name('admin.editProduct');
// Route::get('/admin/edit-product/{id}', [ProductController::class, 'update'])->name('admin.editProduct');
Route::post('/admin/edit-product/{id}', [ProductController::class, 'update'])->name('admin.editProduct');

Route::get('/admin/delete-product/{id}', [ProductController::class, 'destroy'])->name('admin.deleteProduct');
Route::post('/admin/delete-product/{id}', [ProductController::class, 'destroy'])->name('admin.deleteProduct');
Route::delete('/admin/delete-product/{id}', [ProductController::class, 'destroy'])->name('admin.deleteProduct');


Route::get('/', [ProductController::class, 'startProductShow'])->name('startProduct');

// for customer routing
Route::get('/customer/view-product', [ProductController::class, 'allProductShow'])->name('customer.viewProduct');
// products only in same location of chief and customer
Route::get('/customer/view-product-location', [ProductController::class, 'productShowByLocation'])->name('customer.viewProductByLocation');

//search product without login
Route::get('/search', [ProductController::class, 'searchProductsWithoutAuth'])->name('search.products.withoutAuth');

// show products by searching
Route::get('/search/products', [ProductController::class, 'searchProducts'])->name('search.products');

// for cart
Route::get('/customer/cart/{id}', [CartController::class, 'viewCart'])->name('customer.viewCartProduct');

// payment
Route::get('/customer/payment', [TransactionController::class, 'index'])->name('customer.payment');


// add to cart
Route::post('/addcarts', [CartController::class, 'addToCart'])->name('customer.carts.store');

// my cart details
Route::get('/customer/mycart', [CartController::class, 'myCart'])->name('customer.viewMyCartProduct');

// delete item from my cart
Route::post('/customer/delete-mycart/{id}', [CartController::class, 'removeFromCart'])->name('customer.deleteMyCartProduct');
Route::get('/customer/delete-mycart/{id}', [CartController::class, 'removeFromCart'])->name('customer.deleteMyCartProduct');
Route::delete('/customer/delete-mycart/{id}', [CartController::class, 'removeFromCart'])->name('customer.deleteMyCartProduct');
Route::get('/customer/clear-mycart', [CartController::class, 'clearCart'])->name('customer.clearMyCart');
Route::delete('/customer/clear-mycart', [CartController::class, 'clearCart'])->name('customer.clearMyCart');
Route::put('/cart/{cartItemId}', [CartController::class, 'updateCartItemQuantity'])
    ->name('cart.update.quantity');
// FOR ORDER ITEMS
// Route to create a new order
// Route::get('/orders/create', [OrderController::class, 'createOrder'])->name('orders.create');
Route::post('/orders/create', [OrderController::class, 'createOrder'])->name('orders.create');
Route::post('/orders/createCart', [OrderController::class, 'createCartOrder'])->name('orders.createCart');


// Route to update the status of a specific order
Route::put('/orders/{orderId}/update-status/{status}', [OrderController::class, 'updateOrderStatus'])
    ->name('orders.updateStatus');

// Route to view the details of a specific order
Route::get('/orders/{orderId}', [OrderController::class, 'viewOrder'])->name('customer.view');

// Route to view a user's order history
Route::get('/customer/orders', [OrderController::class, 'showOrders'])->name('customer.orders');
Route::get('/admin/{userId}/orders', [OrderController::class, 'viewAdminOrders'])->name('admin.orders');




/*
-----------------------------------------------------------------------------------------------------------------
    FOR ADMIN
-----------------------------------------------------------------------------------------------------------------
*/
// get product details with customer info
Route::get('/admin/product/{id}', [ProductController::class, 'viewProductDetailAdmin'])->name('admin.viewProductDetails');




Route::post('/khalti/payment/verify',[PaymentController::class,'verifyPayment'])->name('khalti.verifyPayment');

Route::post('/khalti/payment/store',[PaymentController::class,'storePayment'])->name('khalti.storePayment');

Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');

// for chef
Route::get('/chef/payments', [PaymentController::class, 'chefIndex'])->name('chef.payments');
Route::patch('/payments/{orderId}/update-status', [PaymentController::class, 'updatePaymentStatus'])->name('update.payment.status');



// chef
Route::get('/orders', [OrderController::class, 'viewChefOrders'])->name('orders.view');
Route::patch('/orders/{orderId}/update-status', [OrderController::class, 'updateOrderStatus'])->name('update.order.status');



// review routes


Route::get('customer/reviews', [ProductReviewController::class, 'index'])->name('customer.reviews.index');
Route::get('customer/reviews/create/{productId}', [ProductReviewController::class, 'create'])->name('customer.reviews.create');
Route::post('customer/reviews', [ProductReviewController::class, 'store'])->name('customer.reviews.store');
Route::get('customer/reviews/{id}', [ProductReviewController::class, 'show'])->name('customer.reviews.show');
Route::get('customer/reviews/{id}/edit', [ProductReviewController::class, 'edit'])->name('customer.reviews.edit');
Route::put('customer/reviews/{id}', [ProductReviewController::class, 'update'])->name('customer.reviews.update');
Route::delete('customer/reviews/{id}', [ProductReviewController::class, 'destroy'])->name('customer.reviews.destroy');



// show profile
use App\Http\Controllers\UserController;

Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

