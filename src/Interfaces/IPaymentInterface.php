<?php
namespace Khaleds\Payment\Interfaces;

interface IPaymentInterface
{

    public function init();
    public function pay($attributes);
    public function callBack();
    public function saveToLogs();

}
