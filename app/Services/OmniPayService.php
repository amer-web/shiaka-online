<?php


namespace App\Services;


use Omnipay\Omnipay;

class OmniPayService
{
    public $gateway;
    public function __construct($method = 'PayPal_Express')
    {

        switch ($method) {
            case 'PayPal_Express':
                $this->gateway = Omnipay::create('PayPal_Express');
                $this->gateway->setUsername(config('services.paypal.Username'));
                $this->gateway->setPassword(config('services.paypal.Password'));
                $this->gateway->setSignature(config('services.paypal.Signature'));
                $this->gateway->setTestMode(config('services.paypal.sendbox'));
                break;
            case 'Myfatoorah':
                $this->gateway = Omnipay::create('Myfatoorah');
                $this->gateway->setApikey(config('services.myFatoorah.token'));
                $this->gateway->setTestMode(config('services.myFatoorah.sendbox'));
                break;
        }



    }

    public function purchase(array $parameters)
    {
        $response = $this->gateway->purchase($parameters)->send();
        return $response;
    }
    public function refund(array $parameters)
    {
        $response = $this->gateway->refund($parameters)->send();
        return $response;
    }
    public function completed(array $parameters)
    {
        $response = $this->gateway->completePurchase($parameters)->send();
        return $response;
    }

    public function getUrlCanceled($order_id)
    {
        return route('frontend.checkout.cancel',$order_id);
    }

    public function getUrlComplete($order_id)
    {
        return route('frontend.checkout.complete',$order_id);
    }


}
