<?php

namespace App\Http\Controllers;


class ZarinpalController extends Controller
{

    protected $merchantId = '935653b4-9beb-4295-90e1-a2d458efbad2';
    protected $callbackUrl = 'https://zeinodin.org/payment/callback';

    static function purchase($amount , $mobile , $email , $callBack)
    {
        $postData = array(
            'merchant_id' => '935653b4-9beb-4295-90e1-a2d458efbad2',
            'callback_url' => $callBack,
            'amount' => (int)$amount * 10 ,
            'description' => 'خرید محتوا',
            'metadata' => [],
            'mobile' => $mobile,
            'email' => $email,
        );

        $ch = curl_init('https://api.zarinpal.com/pg/v4/payment/request.json');
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));

        $response = curl_exec($ch);
        if($response === FALSE){
            die(curl_error($ch));
        }
        $responseData = json_decode($response, TRUE);
        curl_close($ch);

        if(isset($responseData['data']['code'])) {
            if ($responseData['data']['code'] == 100) {
            return $responseData['data']['authority'];
            }
        }
        return null;
    }

    static function payment($authority){
        try {
            $url = "https://www.zarinpal.com/pg/StartPay/$authority";
            header('Location: '.$url);

        } catch (Exception $e) {
            echo($e->getMessage());
        }
    }

    static function verify($authority , $amount)
    {
        $postData = array(
            'merchant_id' => '935653b4-9beb-4295-90e1-a2d458efbad2',
            'amount' => (int)$amount * 10 ,
            'authority' => $authority,
        );

        $ch = curl_init('https://api.zarinpal.com/pg/v4/payment/verify.json');
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));

        $response = curl_exec($ch);
        if($response === FALSE){
            die(curl_error($ch));
        }
        $responseData = json_decode($response, TRUE);
        curl_close($ch);

        $data = [];
        if(isset($responseData['errors']['code'])){
            $data['status'] = 'error';
            $data['data'] = $responseData['errors'];
        }else{
            $data['status'] = 'success';
            $data['data'] = $responseData['data'];
        }

        return $data;
    }



}
