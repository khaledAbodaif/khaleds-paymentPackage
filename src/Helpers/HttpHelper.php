<?php
namespace Khaleds\Payment\Helpers;

trait HttpHelper
{

      private $response=['status'=>true,'message'=>'','data'=>[]];
      
    public function post($uri ,$data){
          
      $httpClient = new \GuzzleHttp\Client(); 

      try{
            $response = $httpClient->request('POST', $uri, [
            'headers' => [
                  'Content-Type' => 'application/json',
            ],
            'body' => json_encode($data)
            ]);
      
            $this->response['data']=$response->getBody()->getContents();
      }
      catch(\Exception $e){
            $this->returnedMessage['status']=false;
            $this->returnedMessage['message']=$e->getMessage();

      }
      return $this->response;
      
      
    }

}