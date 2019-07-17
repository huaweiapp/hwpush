<?php

/**
 * HwPush发送类
 */

namespace hwpush;

class Sender extends Message
{
    protected static $_instance;

    protected $accessToken;

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
     * 设置access_token
     *
     * @param string $accessToken
     */
    public function setAccessToken(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * 发送消息
     *
     * @param array $deviceToken
     * @param array $payload
     * @return bool|string
     */
    public function send(array $deviceToken, array $payload)
    {
        $nspCtx = [
            'ver' => 1,
            'appId' => $this->clientId,
        ];
        $url = [
            'nsp_ctx' => json_encode($nspCtx)
        ];
        $ch = curl_init(self::BASE_PUSH_URL . http_build_query($url));
        $data = [
            'access_token' => $this->accessToken,
            'nsp_svc' => self::NSP_SVC,
            'nsp_ts' => time(),
            'device_token_list' => json_encode($deviceToken),
            'payload' => json_encode($payload),
        ];
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3600);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
        ]);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}