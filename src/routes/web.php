<?php

use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ItemsController;
use App\Http\Controllers\Api\SummaryController;
use App\Http\Controllers\Api\SuppliersController;
use App\Models\Categories;
use App\Models\Items;
use App\Models\Suppliers;
use Illuminate\Support\Facades\Route;

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
    $items = Items::getItems();
    $categories = Categories::all();
    $suppliers = Suppliers::all();
    $summary = Items::getAllSummary();

    return view('dashboard', compact('items', 'categories', 'suppliers', 'summary'));
});

Route::controller(CategoriesController::class)
    ->as('api.categories.')
    ->prefix('api/categories')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
    });

Route::controller(SuppliersController::class)
    ->as('api.suppliers.')
    ->prefix('api/suppliers')
    ->group(function () {
        Route::get('/', 'index')->name('index');    
        Route::post('/store', 'store')->name('store');
    });

Route::controller(ItemsController::class)
    ->as('api.items.')
    ->prefix('api/items')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/stock-limit', 'stockLimit')->name('stock-limit');
        Route::get('/category', 'itemsByCategory')->name('category');
    });

Route::controller(SummaryController::class)
    ->as('api.summary.')
    ->prefix('api/summary')
    ->group(function () {
        Route::get('/general-stock', 'generalStock')->name('general-stock');
        Route::get('/category', 'category')->name('category');
        Route::get('/supplier', 'supplier')->name('supplier');
        Route::get('/all', 'all')->name('all');
    });