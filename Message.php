<?php

/**
 * HwPush基类
 */

namespace hwpush;

class Message
{
    //登录接口地址
    const BASE_LOGIN_URL = 'https://login.cloud.huawei.com';

    //推送接口地址
    const BASE_PUSH_URL = 'https://api.push.hicloud.com/pushsend.do?';

    //授权类型
    const GRANT_TYPE = 'client_credentials';

    //nsp_svc
    const NSP_SVC = 'openpush.message.api.send';

    //clientId
    protected $clientId;

    //clientSecret
    protected $clientSecret;

    /**
     * 初始化配置
     *
     * @param string $clientId
     * @param string $clientSecret
     */
    public function setClient(string $clientId, string $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }
}