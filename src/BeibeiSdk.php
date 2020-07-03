<?php

namespace Wored\BeibeiSdk;


use Hanson\Foundation\Foundation;

/***
 * Class HaiXiaoSdk
 * @package \Wored\BeibeiSdk
 *
 * @property \Wored\BeibeiSdk\Api $api
 */
class BeibeiSdk extends Foundation
{
    protected $providers = [
        ServiceProvider::class
    ];

    public function __construct($config)
    {
        $config['debug'] = $config['debug'] ?? false;
        parent::__construct($config);
    }

    public function request(string $method,array $params=[],string $version = '1.0')
    {
        return $this->api->request($method, $params, $version);
    }
}