<?php

/**
 * HwPush获取通信令牌类
 */

namespace hwpush;

class GetAccessToken extends Message
{
    protected static $_instance;

    private function __construct()
    {
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function getInstance()
    {
        if (!self::$_instance instanceof self) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * 获取access_token
     *
     * @return bool|string
     */
    public function get()
    {
        $ch = curl_init(self::BASE_LOGIN_URL . '/oauth2/v2/token');
        $data = [
            'grant_type' => self::GRANT_TYPE,
            'client_secret' => $this->clientSecret,
            'client_id' => $this->clientId,
        ];
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//// 跳过证书检查
        curl_setopt($ch, CURLOPT_TIMEOUT, 3600);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
        ]);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}