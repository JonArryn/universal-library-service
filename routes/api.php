<?php

    use App\Http\Controllers\Api\BookController;
    use App\Http\Controllers\Api\LibraryBookController;
    use App\Http\Controllers\Api\LibraryController;
    use App\Http\Controllers\Api\UserController;
    use App\Http\Controllers\AuthController;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;


    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [UserController::class, 'store']);


    Route::group(['middleware' => 'auth:sanctum'], function () {
        // session
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        // book
        Route::get('/book', [BookController::class, 'index']);
        Route::get('/book/{book}', [BookController::class, 'show']);
        Route::post('/book', [BookController::class, 'store']);
        Route::put('/book/{book}', [BookController::class, 'update']);
        Route::delete('/book/{book}', [BookController::class, 'destroy']);

        // library
        Route::get('/library', [LibraryController::class, 'index']);
        Route::get('/library/{library}', [LibraryController::class, 'show']);
        Route::post('/library', [LibraryController::class, 'store']);
        Route::get('/library/{library}/book', [LibraryBookController::class, 'index']);
        Route::post('/library/{library}/book', [LibraryBookController::class, 'store']);

    });

