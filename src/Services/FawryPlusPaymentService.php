<?php
namespace Khaleds\Payment\Services;

use Khaleds\Payment\Helpers\HttpHelper;
use \Khaleds\Payment\Interfaces\IPaymentInterface;
class FawryPlusPaymentService implements IPaymentInterface
{
    use HttpHelper;

    //move them to config file

    private $returnUrl = 'https://vilt-admin.test/';
    private $uri;
    private $secretKey;
    private $data=[];

    public function __construct()
    {
        $this->data['merchantCode']=config('khaledsPayment.merchant_code');
//        $this->data['merchantRefNum']=rand(1111,9999);
        $this->data['merchantRefNum']='1234';

        $this->uri=(config('khaledsPayment.debug'))?
            config('khaledsPayment.testing_uri'):
            config('khaledsPayment.pr_uri');

        $this->secretKey=config('khaledsPayment.security_key');
    }


    public function init()
    {
        // TODO: Implement Init() method.

        $this->data['returnUrl']=$this->returnUrl;
        $this->data['signature']="44cfdabdb26cbb7db6d85282d4afca8ad6266429b53c9387aa99572be6da8a89";

        return $this;
    }

    public function pay($attributes)
    {
        $this->data['chargeItems']=  [
            [
                'itemId' => 8,
                'description' => "Product Description",
                'price' => 580.55,
                'quantity' => 1
            ]];
        $this->data['merchantRefNum']='0258';
        $this->data['returnUrl']='https://khaled.com';
//        $this->data['customerProfileId']=15;
//        $this->data['chargeItems']=$attributes['items'];
//dd($this->data['merchantRefNum']);
//        dd($this->data['chargeItems']);
//        $this->data['signature']=hash('sha256',
//        $this->data['merchantCode'] . $this->data['merchantRefNum']."15".$this->data['returnUrl']
//       . $this->data['chargeItems'][0]['itemId'].$this->data['chargeItems'][0]['quantity'].$this->data['chargeItems'][0]['price']
//        .$this->secretKey
//        );
//        $this->data['signature']="44cfdabdb26cbb7db6d85282d4afca8ad6266429b53c9387aa99572be6da8a89";
//        $this->data['signature']= "2ca4c078ab0d4c50ba90e31b3b0339d4d4ae5b32f97092dd9e9c07888c7eef36";
//        $this->data['returnUrl']=$attributes['returnedUrl'];
        $khaled=[
            "merchantCode"=>$this->data['merchantCode'],
            "merchantRefNum"=>1589,
            "returnUrl"=>"https://khaled.com",
            "chargeItems"=>[
                [
                    'itemId'=>15,"quantity"=>9,"price"=>round(150,2)
                ]
                ],
        ];
        $khaled["signature"]=hash('sha256',$khaled['merchantCode'].$khaled["merchantRefNum"].$khaled["returnUrl"]
        .$khaled["chargeItems"][0]["itemId"].$khaled["chargeItems"][0]["quantity"].$khaled["chargeItems"][0]["price"].$this->secretKey
        );
//        dd($khaled);
//        dd(['s'=>$this->data,'new-seg'=>hash('sha256',
//        $this->data['merchantCode'] . $this->data['merchantRefNum']."15".$this->data['returnUrl']
//       . $this->data['chargeItems'][0]['itemId'].$this->data['chargeItems'][0]['quantity'].$this->data['chargeItems'][0]['price']
//        .'sha256'),'web'=>hash('SHA256', "siYxylRjSPwyUDLWDo/Dsw==" . "1234" . "https://vilt-admin.test/"
//            . "8" .
//            "1" .
//            "580.55" . "259af31fc2f74453b3a55739b21ae9ef")]);
        return $this->post($this->uri,$khaled);

    }

    public function callBack()
    {
        // TODO: Implement CallBack() method.
        //make event at the begging that say callback triggered

    }

    public function saveToLogs()
    {
        //wait for it
        // TODO: Implement SaveToLogs() method.
    // add repo
        //save to logs model ,model id ,

        //migrate payment table from repo with data and status
        // create the scenario
        //should implement other integrations try wallet
    }
}
