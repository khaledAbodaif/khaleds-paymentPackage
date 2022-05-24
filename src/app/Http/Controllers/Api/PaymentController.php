<?php

namespace Khaleds\Payment\app\Http\Controllers\Api;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Khaleds\Payment\Factories\PaymentFactory;
use Khaleds\Payment\Helpers\ApiResponse;
use Khaleds\Payment\Services\FawryPlusPaymentService;

class PaymentController extends Controller
{
    //

    private $payment;
    public function __construct(PaymentFactory $payment)
    {
        $this->payment=$payment;
    }


    //factory pattern to chosse from payments 
    // object from interface
    // test postman
    //move fawry config to config
    //data {link}
    // token idea
    
    /*
    he want to add package that
    add payments to database that  in use and enable disable 
    
    */
    
    public function index(Request $request){

        try{
        $resualt=$this->payment->get(request()->get('paymentMethod'))
        ->init()
        ->pay();}
        catch(\Exception $e){
            
            return ApiResponse::errors($e->getMessage(),400);
        }
        
        if(!$resualt['status'])
            return ApiResponse::errors($resualt['message'],500);

       return  ApiResponse::data($resualt['data'],"done",200);
    }
}