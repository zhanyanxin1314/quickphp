<?php

// 数据库配置
$config['db']['host'] = '127.0.0.1';
$config['db']['username'] = 'root';
$config['db']['password'] = 'root';
$config['db']['dbname'] = 'blog';

// 默认模块和控制器以及操作名
$config['defaultModule'] = 'home';
$config['defaultController'] = 'Item';
$config['defaultAction'] = 'index';

//定义模板路径
define('TEMPLATE_PATH' , 'app/home/views/public/');
return $config;

