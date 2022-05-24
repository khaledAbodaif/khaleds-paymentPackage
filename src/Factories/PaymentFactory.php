<?php

namespace Khaleds\Payment\Factories;

use Exception;
use Khaleds\Payment\Services\FawryPlusPaymentService;

class PaymentFactory{
      

      public function get(String $paymentMethod = null)
      {
            switch ($paymentMethod) {
                  case ("fawry") : {
                    return (new FawryPlusPaymentService());
                    break;
                  }
                  default : {
                      throw new Exception("Invalid payment gateway");
                  }
            }
            
      }
}