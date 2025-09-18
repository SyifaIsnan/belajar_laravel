<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\APIContohController;
use App\Http\Middleware\Adminmiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/products", [ProductController::class,"index"]);

// Route::prefix("products")->group(function () { 
//     Route::get("/", [ProductController::class,"index"]); # nanti di postman nya /api/products/
//     Route::post("/", [ProductController::class,"store"]); # /api/products/
//     Route::get("/{id}", [ProductController::class,"show"]); # buat  controller show supaya tampil di postman
//     Route::delete("/{id}", [ProductController::class,"destroy"]); # buat destroy controller show supaya tampil di postman
//     Route::put("/{id}", [ProductController::class,"update"]); # buat update controller show supaya tampil di postman
// });

Route::prefix("v1")->group(function () {
    #
    Route::prefix("auth")->group(function () {
        Route::post("daftar", [AuthController::class,"register"]);
    });
});

Route::prefix("v1")->group(function () {
    #
    Route::prefix("auth")->group(function () {
        Route::post("login", [AuthController::class,"login"]);
        Route::middleware("auth:sanctum")->post("logout", [AuthController::class,"logout"]); //buat daftarin controller logout

    });

    
    // Route::prefix("products")->group(function () { 
    //     Route::apiResource("products", ProductController::class); #
    // });

    // Route::middleware("auth:sanctum")->group(function () { #middle wear itu semcam session, butuh login terlebih dahulu
    //     Route::apiResource("products", ProductController::class);
    // });

    Route::middleware(['auth:sanctum',Adminmiddleware::class])->group(function () { #middle wear itu semcam session, butuh login terlebih dahulu
        Route::apiResource("products", ProductController::class);
        Route::apiResource("posts", PostController::class);
    });

    // Route::middleware("auth:sanctum")->group(function () {
    //     Route::post("logout", AuthController::class);
    // });


});

