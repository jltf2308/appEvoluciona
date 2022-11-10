<?php

use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function () {
    // Route::get('/user', function (Request $request) {
    //     return $request->user()->load('person');
    // });
    Route::apiResource('company', CompanyController::class);
    // Route::apiResource('person', PersonController::class);
    Route::apiResource('user', UserController::class);
    // Route::apiResource('questionary', QuestionaryController::class);
});
