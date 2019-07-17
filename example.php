<?php

use hwpush\GetAccessToken;
use hwpush\Sender;

include_once(dirname(__FILE__) . '/autoload.php');

//APP ID
$clientId = 'xxx';
//APP SECRET
$clientSecret = 'xxx';
//获取【AccessToken】实例
$access = GetAccessToken::getInstance();
//设置通信参数
$access->setClient($clientId, $clientSecret);
//获取access_token
$response = $access->get();
$response = json_decode($response, true);
/**
 * Array(
 * [access_token] => xxxx
 * [expires_in] => 3600
 * [token_type] => Bearer
 * )
 */
print_r($response);


//获取 【Sender】实例
$sender = Sender::getInstance();
//设置通信参数
$sender->setClient($clientId, $clientSecret);
//设置通信令牌
$sender->setAccessToken($response['access_token']);
//定义设备Token列表
$deviceTokenList = [
    '0867778034447519300001659700CN01'
];
//定义payload，下方使用的是：系统通知栏消息
$payload = ['hps' => [
    'msg' => [
        'type' => 3,
        'body' => [
            'content' => 'Hello,is me !',
            'title' => 'Who are you?',
        ],
        'action' => [
            'type' => 1,
            'param' => [
                "intent" => "#Intent;compo=com.rvr/.Activity;S.W=U;end"
            ]
        ],
    ]
]];
$response = $sender->send($deviceTokenList, $payload);
//{"code":"80000000","msg":"Success","requestId":"154335160415079796001601"}
print_r($response);