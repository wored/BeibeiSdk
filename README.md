<h1 align="center">贝贝网开放接口SDK</h1>

## 安装

```shell
$ composer require wored/beibei-sdk -vvv
```

## 使用
```php
<?php
use \Wored\BeibeiSdk\BeibeiSdk;

$config = [
    'app_id'  => '******',
    'session' => '*******************************',
    'secret'  => '*******************************',
    'rootUrl' => 'http://api.open.beibei.com',
];
//贝贝网SDK
$beibei = new BeibeiSdk($config);
//获取物流公司
$ret = $beibei->request('beibei.outer.logistics.company.get');
```
## License

MIT