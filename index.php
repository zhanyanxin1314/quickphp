<?php
//定义应用目录为当前目录
define('APP_PATH',__DIR__.'/');

//定义核心框架根目录
define('CORE_PATH',__DIR__.'/quickphp');

//加载核心框架文件
require(APP_PATH.'quickphp/Quickphp.php');

// 开启调试模式
define('APP_DEBUG', true);

//加载配置文件
$config = require(APP_PATH.'config/config.php');

//实例化框架类1
(new quickphp\Quickphp($config))->run();

