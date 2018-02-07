<?php

namespace app\home\controllers;

use quickphp\base\Controller;
use app\home\models\ItemModel;
class PhpController extends Controller
{
  
   public function index()
   {
      $content = 'php是最好的语言';
      $this->assgin('content',$content);
      $this->render();  
   }

   /*
     * 环境搭建-phpstudy搭建服务器
   */
   public function hja()
   {
      $content = '环境搭建';
      $this->assgin('content',$content);  
      $this->render();
   }

   /*
     * Mysql数据库-数据类型选择
   */
   public function mdba()
   {
      $item = new ItemModel();
      $list = $item->getMdba();
      $this->assgin('content',$list['item_name']);
      $this->render();
   }

}

