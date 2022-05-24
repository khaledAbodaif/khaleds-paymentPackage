<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Khaleds\Payment\Services\FawryPlusPaymentService;

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

Route::namespace('Khaleds\Payment\app\Http\Controllers\Api')
    ->group(function () {
        Route::post("test", 'PaymentController@index');
    });