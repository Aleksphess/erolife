<?php

namespace common\components;

class Iiko
{

     const USER_ID = 'cardexpress';

     const USER_SECRET = 'G12cb8rt11tt';


    public function discounts()
    {
        $url = 'https://iiko.biz:9900/api/0/deliverySettings/deliveryDiscounts';
        $get = [
            'access_token' => str_replace('"','',$this->token()),
            'organization' => str_replace('"','',$this->organization())

        ];
        //  $url = $url . (strpos($url, "?") === FALSE ? "?" : "") . http_build_query($get);
        //var_dump($url);die();
        $result = json_decode($this->curl_get($url,$get));
        return $result;

    }



    public function city()
    {
        $url = 'https://iiko.biz:9900/api/0/cities/citiesList';
        $get = [
            'access_token' => str_replace('"','',$this->token()),
            'organization' => str_replace('"','',$this->organization())

        ];
      //  $url = $url . (strpos($url, "?") === FALSE ? "?" : "") . http_build_query($get);
        //var_dump($url);die();
        $result = json_decode($this->curl_get($url,$get));
        foreach ($result as $item)
        {
            return $item->id;

        }

    }
    public function streets()
    {
        $url = 'https://iiko.biz:9900/api/0/streets/streets';
        $get = [
            'access_token' => str_replace('"','',$this->token()),
            'organization' => '17b72f5b-9226-11e7-80df-d8d38565926f',
            'city'         => str_replace('"','',$this->city()),

        ];
        $options = array(
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json",
                "cache-control: no-cache",
                "postman-token: ".$this->getGUID()
            ));
        //$url = $url . (strpos($url, "?") === FALSE ? "?" : "") . http_build_query($get);
        //var_dump($url);

        //var_dump($url);die();
        $result = json_decode($this->curl_get($url,$get,$options));
        $streets = [];
        foreach ($result as $item)
        {
            $streets[]=$item->name;
        }
        return $streets;

    }
    public function orderInfo($order_id)
    {
        $url = 'https://iiko.biz:9900/api/0/orders/info';
        $get = [
            'access_token' => str_replace('"','',$this->token()),
            'organization' => str_replace('"','',$this->organization()),
            'order'         => $order_id,

        ];
        //$url = $url . (strpos($url, "?") === FALSE ? "?" : "") . http_build_query($get);
        //var_dump($url);

        //var_dump($url);die();
        $result = $this->curl_get($url,$get);
        return $result;

    }


    public function add($post)
    {
        $url = 'https://iiko.biz:9900/api/0/orders/add';
        $get = [
            'access_token' => str_replace('"','',$this->token()),

        ];
        $url = $url . (strpos($url, "?") === FALSE ? "?" : "") . http_build_query($get);
        //var_dump($url);die();
        $result = $this->curl_post($url,$post);
        return $result;

    }

    public function nomenclature()
    {
        $url = 'https://iiko.biz:9900/api/0/nomenclature/'.str_replace('"','',$this->organization());

        $get = [
            'access_token' => str_replace('"','',$this->token()),
        ];
        return json_decode($this->curl_get($url,$get));
    }

    public function organization()
    {
        $url = 'https://iiko.biz:9900/api/0/organization/list';

        $get = [
            'access_token' => str_replace('"','',$this->token()),
        ];
        $organization = json_decode($this->curl_get($url,$get));
        foreach ($organization as $item) {
            return $item->id;
        }

    }

    public function token()
    {
        $url = 'https://iiko.biz:9900/api/0/auth/access_token';

        $get = [
            'user_id' => self::USER_ID,
            'user_secret'   => self::USER_SECRET
        ];
        return $this->curl_get($url,$get);
    }


    /**
     * http://www.php.net/manual/ru/function.curl-exec.php
     */
    /**
     * Send a GET request using cURL
     * @param string $url to request
     * @param array $get values to send
     * @param array $options for cURL
     * @return string
     */

    function curl_get($url, array $get = NULL, array $options = array()) {
        $defaults = array(
            CURLOPT_URL => $url . (strpos($url, "?") === FALSE ? "?" : "") . http_build_query($get) ,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_DNS_USE_GLOBAL_CACHE => false,
            CURLOPT_SSL_VERIFYHOST => 0, //unsafe, but the fastest solution for the error " SSL certificate problem, verify that the CA cert is OK"
            CURLOPT_SSL_VERIFYPEER => 0, //unsafe, but the fastest solution for the error " SSL certificate problem, verify that the CA cert is OK"
        );
       
        $ch = curl_init();
        curl_setopt_array($ch, ($options + $defaults));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        //var_dump(curl_exec($ch));
        if (!$result = curl_exec($ch)) {
            trigger_error(curl_error($ch));
        }

        curl_close($ch);
        return $result;
    }
    public function curl_post($url, $post = null, array $options = array()) {
        $defaults = array(

            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json",
                "cache-control: no-cache",
                "postman-token: ".$this->getGUID()
            ),
            CURLOPT_URL => $url,
            CURLOPT_FRESH_CONNECT => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FORBID_REUSE => 1,
            CURLOPT_SSL_VERIFYHOST =>0,//unsafe, but the fastest solution for the error " SSL certificate problem, verify that the CA cert is OK"
            CURLOPT_SSL_VERIFYPEER=>0, //unsafe, but the fastest solution for the error " SSL certificate problem, verify that the CA cert is OK"
            CURLOPT_POSTFIELDS => $post
        );
        $ch = curl_init();

        curl_setopt_array($ch,  $defaults);
       // var_dump(curl_exec($ch));die();
        if( ! $result = curl_exec($ch)){
            trigger_error(curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
    public function getGUID(){
        if (function_exists("com_create_guid")){
            return com_create_guid();
        }else{
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charId = md5(uniqid(rand(), true));
            $hyphen = chr(45);// "-"
            $uuid =substr($charId, 0, 8).$hyphen
                .substr($charId, 8, 4).$hyphen
                .substr($charId,12, 4).$hyphen
                .substr($charId,16, 4).$hyphen
                .substr($charId,20,12);
            return $uuid;
        }
    }




}