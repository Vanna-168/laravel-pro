<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\InvoiceControler;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleControler;
use App\Http\Controllers\SaleController;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', [ProductController::class, 'home']);
Route::get('/table', function () {
    return view('table');
});
// Route::get('/login', function () {
//     return view('auth.login');
// });
Route::get('/register', function () {
    return view('auth.register');
});
//login 
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::get('/auth/login', [UserController::class, 'login'])->name('auth.login');
Route::get('/auth/logout', [UserController::class, 'logout'])->name('auth.logout');
//menu
Route::get('/product/menu', [ProductController::class, 'menu'])->name('product.menu');
Route::get('/product/reciept', [ProductController::class, 'reciept'])->name('product.reciept');
//product
Route::get('/product/index', [ProductController::class, 'index'])->name('product.index');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/form', [ProductController::class, 'create'])->name('product.form');
Route::get('/product/formupdate/{id}', [ProductController::class, 'edit'])->name('product.formupdate');
Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
Route::get('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

//brand
Route::get('/brand/index', [BrandController::class, 'index'])->name('brand.index');
Route::post('/brand/store', [BrandController::class, 'store'])->name('brand.store');
//category
Route::get('/category/index', [CategoriesController::class, 'index'])->name('category.index');
Route::post('/category/store', [CategoriesController::class, 'store'])->name('category.store');

Route::get('upload/search', [ProductController::class, 'search'])->name('search');

Route::get('/export-product', [ExportController::class, 'productExcel']);
Route::get('/export-report', [ExportController::class, 'reportExcel']);

//profiles
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update');

Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/complete', [SaleControler::class, 'complete'])->name('complete');
Route::get('/invoice', [InvoiceControler::class, 'printInvoice'])->name('invoice');

Route::get('/sale', [SaleControler::class, 'reportSale'])->name('sale');
Route::get('/order', [OrderController::class, 'reportOrder'])->name('order');
Route::get('/order-detail-json/{id}', [OrderController::class, 'getOrderDetailJson']);
Route::get('/sale-detail-json/{id}', [SaleControler::class, 'getSaleDetailJson']);
Route::get('/report/orderDetail', [ReportController::class, 'orderDetailReport'])->name('report.orderDetail');
Route::get('/report/saleDetail', [ReportController::class, 'saleDetailReport'])->name('report.saleDetail');
