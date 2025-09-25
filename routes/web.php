<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('users', UserController::class);

    Route::apiResource('produits', ProduitController::class);

    Route::apiResource('orders', OrderController::class);

    Route::apiResource('order-items', OrderItemController::class);

    Route::apiResource('roles', RoleController::class);

    Route::apiResource('regions', RegionController::class);

    Route::apiResource('categories', CategorieController::class);

    Route::apiResource('messages', MessageController::class);

    Route::apiResource('payments', PaymentController::class);
});


Route::post('/register', [UserController::class, 'store']);
Route::post('/login', function () {
    return response()->json(['message' => 'Login route (à implémenter)']);
});

// Route::get('/', function () {
//     return view('welcome');
// });
