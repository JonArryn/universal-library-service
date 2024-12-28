<?php

    use App\Http\Controllers\Api\BookController;
    use App\Http\Controllers\Api\LibraryController;
    use App\Http\Controllers\Api\UserController;
    use App\Http\Controllers\AuthController;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;


    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [UserController::class, 'store']);

    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    Route::get('/library', [LibraryController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/book', [BookController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/book', [BookController::class, 'store'])->middleware('auth:sanctum');
