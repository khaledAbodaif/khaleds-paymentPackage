<?php

namespace Khaleds\Payment\Factories;

use Exception;
use Khaleds\Payment\Interfaces\IPaymentInterface;
use Khaleds\Payment\Services\FawryPlusPaymentService;

class PaymentFactory{


    protected $gateways = [];

    // add gitways methods
    function register ($name, IPaymentInterface $instance) {
        $this->gateways[$name] = $instance;
        return $this;
    }

    function get($name) {
        if (array_key_exists($name, $this->gateways)) {
            return $this->gateways[$name];
        } else {
            throw new Exception("Invalid gateway");
        }
    }
}
