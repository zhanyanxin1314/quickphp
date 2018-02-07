<?php

namespace quickphp\base;

/**
 * 视图基类
 */
class View
{
  protected $variables = array();

  protected $_module;

  protected $_controller;
  
  protected $_action;


 /*
  * 构造函数 初始化属性
  */
  public function __construct($module,$controller,$action)
  {
    $this->_module = strtolower($module);
    $this->_controller = strtolower($controller);
    $this->_action = strtolower($action);
  }

  /*
  * 分配变量
  */
  public function assgin($name,$value)
  {
     $this->variables[$name] = $value;
  }

  /*
  * 渲染显示
  */
  public function render()
  {
    extract($this->variables);
    $defaultHeader  = 'app/' . $this->_module . '/views/public/header.html';
    $defaultFooter  = 'app/' . $this->_module . '/views/public/footer.html';
    $defaultLeft  = 'app/' . $this->_module . '/views/public/left.html';
    $controllerLayout = 'app/' . $this->_module . '/views/' . $this->_controller . '/' . $this->_action . '.html';
    // 页头文件
    if (!is_file($defaultHeader)) {
      echo "<h1>无法找到头部文件</h1>";
    }
    if($this->_module == 'item') {
       //左侧文件
       if(!is_file($defaultLeft)) {
          echo "<h1>无法找到左侧文件</h1>";
       }
    }
    // 视图文件
    if (is_file($controllerLayout)) {
      include ($controllerLayout);
    } else {
      echo "<h1>无法找到视图文件</h1>";
    }

    // 页脚文件
    if (!is_file($defaultFooter)) {
      echo "<h1>无法找到页脚文件</h1>";
    } 
  }

}
