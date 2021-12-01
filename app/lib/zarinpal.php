<?php
namespace App\lib;
use DB;
/*require_once 'nusoap.php';*/
use nusoap_client;
class zarinpal
{
    public $MerchantID;
    public function __construct()
    {
        $this->MerchantID="935653b4-9beb-4295-90e1-a2d458efbad2";
    }
    public function pay($Amount,$Email,$Mobile)
    {
        $Description = 'شرکت در دوره';  // Required
        $CallbackURL = url('/order'); // Required
        $client = new nusoap_client('https://www.zarinpal.com/pg/services/WebGate/wsdl', 'wsdl');
        $client->soap_defencoding = 'UTF-8';
        $result = $client->call('PaymentRequest', [
            [
                'MerchantID'     => $this->MerchantID,
                'Amount'         => $Amount,
                'Description'    => $Description,
                'Email'          => $Email,
                'Mobile'         => $Mobile,
                'CallbackURL'    => $CallbackURL,
            ],
        ]);

        //Redirect to URL You can do it also by creating a form
        if ($result['Status'] == 100) {
            return $result['Authority'];
        } else {
            return false;
        }
    }
}