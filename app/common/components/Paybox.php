<?php

namespace common\components;



class Paybox
{
    public function paybox_link($order_id,$amount)
    {

        $desc = "topperz.kz";
        $fail_url = "http://{$_SERVER['HTTP_HOST']}/";
        $suc_url = "http://{$_SERVER['HTTP_HOST']}/";
        $pg_salt = rand(9658569, 44484542177552);
        $pg_salt .= 'topperzaleksphess';
        $to_sig = "payment.php;{$amount};KZT;{$desc};{$fail_url};504586;{$order_id};{$pg_salt};{$suc_url};Ptt9d88VjYGv0fUA";
        $sig = md5($to_sig);

        $pay_url = 'https://www.paybox.kz/payment.php?';
        $pay_url .= 'pg_merchant_id=504586&';
        $pay_url .= "pg_order_id={$order_id}&";
        $pay_url .= "pg_amount={$amount}&";
        $pay_url .= "pg_currency=KZT&";
        $pay_url .= "pg_success_url={$suc_url}&";
        $pay_url .= "pg_failure_url={$fail_url}&";
        $pay_url .= "pg_description={$desc}&";
        $pay_url .= "pg_salt={$pg_salt}&"; //это случайная строка, так написано в документации
        $pay_url .= "pg_sig={$sig}";

        return $pay_url;

    }
}
