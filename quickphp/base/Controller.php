<?php

namespace quickphp\base;

class Controller
{
   protected $_module;
   protected $_controller;
   protected $_action;
   protected $_view;


  /*
   * 构造函数，初始化属性，并实例化模型
  */
 public function __construct($module,$controller,$action)
 {
 
     $this->_module = $module;
    
     $this->_controller = $controller;

     $this->_action = $action;

     $this->_view  = new View($module,$controller,$action);
 }

 /*
  * 分配变量
 */
 public function assgin($name,$value)
 {
    $this->_view->assgin($name,$value);
 }

 /*
  * 渲染视图
 */
 public function render()
 {
    $this->_view->render();
 }

}
