<?php
namespace Khaleds\Payment\Services;

use Khaleds\Payment\Helpers\HttpHelper;
use \Khaleds\Payment\Interfaces\IPaymentInterface;
class FawryPlusPaymentService implements IPaymentInterface
{
    use HttpHelper;

    //move them to config file
    private $merchantCode    = 'siYxylRjSPwyUDLWDo/Dsw==';
    private $merchantRefNum  = '1234';
    private $returnUrl = 'https://vilt-admin.test/';
    private $uri = 'https://atfawry.fawrystaging.com/fawrypay-api/api/payments/init/';

    private $data=[];

    
    public function init()
    {
        // TODO: Implement Init() method.
        $this->data['merchantCode']=$this->merchantCode;
        $this->data['merchantRefNum']=$this->merchantRefNum;
        $this->data['returnUrl']=$this->returnUrl;
        $this->data['signature']="44cfdabdb26cbb7db6d85282d4afca8ad6266429b53c9387aa99572be6da8a89";

        return $this;
    }

    public function pay()
    {
        $this->data['chargeItems']=  [
            [
                'itemId' => "8",
                'description' => "Product Description",
                'price' => 580.55,
                'quantity' => 1
            ]];
            
        return $this->post($this->uri,$this->data);
           
    }

    public function callBack()
    {
        // TODO: Implement CallBack() method.
    }

    public function saveToLogs()
    {
        // TODO: Implement SaveToLogs() method.
    }
}