<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VoterController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Voter Registration Endpoints
Route::post('/voters/register', [VoterController::class, 'register']);
Route::post('/voters/bulk-register', [VoterController::class, 'bulkRegister']);
