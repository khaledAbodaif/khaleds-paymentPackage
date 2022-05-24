<?php

namespace Khaleds\Payment\app\Http\Controllers\Api;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Khaleds\Payment\Factories\PaymentFactory;
use Khaleds\Payment\Helpers\ApiResponse;


/*
    this class for test the service act as example for how to use this package
*/
class PaymentController extends Controller
{

    private $payment;
    
    /*
        this constructor get an object from factory class that 
        get an instanse from payment methods you can find 
        it's registration in payment service provider
            
    */
    public function __construct(PaymentFactory $payment)
    {
        $this->payment=$payment;
    }


 

    /*
        |try if the payment method is invalid will fire ex 
        |and return the ex message "invalid getway "
    
    
       | try the payment method  if any ex happen from payment side
       | will retrun status false and the ex message 
        
        
    
    */

    public function index(Request $request){

        try{
            
        $resualt=$this->payment->get(request()->get('paymentMethod'))
        ->init($request->only(['returnUrl','chargeItems']))
        ->pay();
        
        }
        catch(\Exception $e){

            return ApiResponse::errors($e->getMessage(),400);
        }

        if(!$resualt['status'])
            return ApiResponse::errors($resualt['message'],500);

       return  ApiResponse::data($resualt['data'],"done",200);
    }
}