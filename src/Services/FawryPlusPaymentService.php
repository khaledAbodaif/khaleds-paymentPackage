<?php

namespace Khaleds\Payment\Services;

use Khaleds\Payment\Helpers\HttpHelper;
use Khaleds\Payment\Interfaces\IFawryInterface;
use \Khaleds\Payment\Interfaces\IPaymentInterface;


class FawryPlusPaymentService implements IPaymentInterface ,IFawryInterface
{
    use HttpHelper;


    private $uri;
    private $secretKey;
    private $merchantCode;
    private $data = [];

    /*
        constractor get the data from config file that provided from service provider
    
     */

    public function __construct($merchantCode, $uri, $secretKey)
    {

        $this->merchantCode = $merchantCode;
        $this->uri = $uri;
        $this->secretKey = $secretKey;
    }

    
    /**
     * 
     * initiat the request and return self object
     */

    public function init($attributes)
    {
        
        $this->data = collect($attributes)->merge([
            'merchantRefNum' => rand(1111, 9999),
            'merchantCode' => $this->merchantCode,
        ]);
        $this->data['signature'] = $this->generateSignature();

        return $this;
    }

    
    /**
     * 
     * call the http post method and return status ,data and message  
     * 
     */
    
    public function pay()
    {


        return $this->post($this->uri, $this->data);
    }


    /**
     * 
     * depending of what the callback will do 
     * 
     * i recommend fireing event and the user deal with the response if PAID,EXPIRED etc
     * 
     * 
     */

    
    public function callBack()
    {
        // TODO: Implement CallBack() method.
        //make event at the begging that say callback triggered

    }

    public function saveToLogs()
    {
        //wait for it
        // TODO: Implement SaveToLogs() method.
        
    }


    /**
     * 
     * generating signature that fawry want for auth
     * 
     *  */ 

    public function generateSignature()
    {
        $data = collect($this->data['chargeItems']);

        $items = $data->map(function ($item) {
            return $item['itemId'] . $item['quantity'] . (float)$item['price'];
        })->join('');
    
        return hash(
            'sha256',
            $this->data['merchantCode'] .
                $this->data['merchantRefNum'] .
                $this->data['returnUrl'] .
                $items .
                $this->secretKey
        );
    }
}