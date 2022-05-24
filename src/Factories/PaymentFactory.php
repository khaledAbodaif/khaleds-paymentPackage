<?php

namespace Khaleds\Payment\Factories;

use Exception;
use Khaleds\Payment\Interfaces\IPaymentInterface;

/**
 * 
 * this class choose and register payment methods that provided in service provider
 * 
 */
class PaymentFactory{


    protected $gateways = [];

    /**
     * 
     * register array of payment methods that get it from service provider
     * array consist of name of method and object from payment interface calss 
     * 
     */
    function register ($name, IPaymentInterface $instance) {
        $this->gateways[$name] = $instance;
        return $this;
    }

    /**
     * 
     * get the payment class that the user want 
     * if not exist return ex
     * 
     */

    function get($name) {
        if (array_key_exists($name, $this->gateways)) {
            return $this->gateways[$name];
        } else {
            throw new Exception("Invalid gateway");
        }
    }
}