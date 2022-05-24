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

Route::get('test2', function () {
    $merchantCode    = 'siYxylRjSPwyUDLWDo/Dsw==';
    $merchantRefNum  = '99900642041';
    $merchant_cust_prof_id  = '458626698';
    $payment_method = 'PAYATFAWRY';
    $amount = '580.55';
    $merchant_sec_key =  '259af31fc2f74453b3a55739b21ae9ef'; // For the sake of demonstration
    $signature = hash('sha256', $merchantCode . $merchantRefNum . $merchant_cust_prof_id . "https://vilt-admin.test/" . "8" . "1" . "580.55" . "sha256");
    $data =   [
        'merchantCode' => "siYxylRjSPwyUDLWDo/Dsw==",
        'merchantRefNum' => "1234",
        'chargeItems' => [
            [
                'itemId' => "8",
                'description' => "Product Description",
                'price' => 580.55,
                'quantity' => 1
            ]

        ],
        'returnUrl' => "https://vilt-admin.test/",
        'signature' => '44cfdabdb26cbb7db6d85282d4afca8ad6266429b53c9387aa99572be6da8a89'

    ];
    $httpClient = new \GuzzleHttp\Client(); // guzzle 6.3
    $response = $httpClient->request('POST', 'https://atfawry.fawrystaging.com/fawrypay-api/api/payments/init', [
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'body' => json_encode($data)
    ]);
    return $response->getBody();
    $response = json_decode($response->getBody(), true);
});
Route::get('fawry', function () {
   
});
Route::namespace('Khaleds\Payment\app\Http\Controllers\Api')
    ->group(function () {
        Route::post("test", 'PaymentController@index');
    });
    // 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 