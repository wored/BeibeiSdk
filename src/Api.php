<?php

namespace Wored\BeibeiSdk;

use Hanson\Foundation\AbstractAPI;
use Hanson\Foundation\Log;

class Api extends AbstractAPI
{
    public $config;
    public $timestamp;
    public $loginData;

    /**
     * Api constructor.
     * @param $appkey
     * @param $appsecret
     * @param $sid
     * @param $baseUrl
     */
    public function __construct(BeibeiSdk $beibeiSdk)
    {
        $this->config = $beibeiSdk->getConfig();
    }


    /**
     * api请求方法
     * @param $method域名后链接
     * @param $params账后相关参数以外请求参数
     * @return mixed
     * @throws \Exception
     */
    public function request(string $method,array $params,string $version = '1.0')
    {
        $request = [
            'method'    => $method,
            'version'   => $version,
            'timestamp' => date('Y-m-d H:i:s'),
            'format'    => 'json',
            'app_id'    => $this->config['app_id'],
            'session'   => $this->config['session'],
        ];
        $request = array_merge($request, $params);
        $request['sign'] = $this->sign($request);
        $url = $this->config['rootUrl'] . '/outer_api/out_gateway/route.html';
        $http = $this->getHttp();
        $response = call_user_func_array([$http, 'POST'], [$url, $request]);
        return json_decode(strval($response->getBody()), true);
    }


    /**
     * 生成签名
     * @param array $params请求的所有参数
     * @return string
     */
    public function sign(array $params)
    {
        unset($params['sign']);
        ksort($params, SORT_STRING);
        $str = '';
        foreach ($params as $k => $v) {
            if (!empty($v)) {
                $str .= $k . $v;
            }
        }
        $str = $this->config['secret'] . $str . $this->config['secret'];
        return strtoupper(md5($str));//加密生成签名
    }
}