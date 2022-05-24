<?php

namespace Khaleds\Payment\Interfaces;

interface IPaymentInterface
{

    public function init($attributes);
    public function pay();
    public function callBack();
    public function saveToLogs();
}