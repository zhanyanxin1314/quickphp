<?php

namespace quickphp;

/*
 * quick核心
*/
class Quickphp 
{
    //配置内容
    protected $config = [];

    //实例化
    public function __construct($config)
    {
	$this->config = $config;
        
    }

    /*
      * 运行程序
    */
    public function run()
    {
        spl_autoload_register(array($this,'loadClass'));
        $this->setReporting();
        $this->unregisterGlobals();
        $this->setDbConfig();
        $this->route();
    }

    /*
      * 路由处理
    */
    public function route()
    {
      $moduleName = $this->config['defaultModule'];
      $controllerName = $this->config['defaultController'];
      $actionName = $this->config['defaultAction'];
      $url = $_SERVER['REQUEST_URI'];
      $param = [];
      //清楚?后面的值
      $position = strpos($url, '?');
      $url = $position === false ? $url : substr($url, 0, $position);
      $url = trim($url, '/');
      if ($url) {
          // 使用“/”分割字符串，并保存在数组中
          $urlArray = explode('/', $url);
          // 删除空的数组元素
          $urlArray = array_filter($urlArray);
          //获取模块名称
          $moduleName = strtolower($urlArray[0]);
    	  //获取控制器名
          $controllerName = ucfirst($urlArray[1]);
          // 获取动作名
          array_shift($urlArray);
          $actionName = $urlArray ? $urlArray[1] : $actionName;
          // 获取URL参数
          array_shift($urlArray); 
          array_shift($urlArray);
          $param = $urlArray ? $urlArray : array();
         
      }
          //判断控制器和方法是否存在
          $controller = 'app\\' . $moduleName . '\\controllers\\'.$controllerName.'Controller'; 
          if(!class_exists($controller)){
	      exit($controller . '控制器不存在');
          }
          if(!method_exists($controller,$actionName)){
              exit($actionName . '方法不存在');
          } 
          $dispatch = new $controller($moduleName,$controllerName, $actionName);
          call_user_func_array(array($dispatch, $actionName), $param);
    }

    /*
      * 检测开发环境
    */
    public function setReporting()
    {
        if(APP_DEBUG === true){
          error_reporting(E_ALL);
          ini_set('display_errors','On');
	} else {
    	  error_reporting(E_ALL);
          ini_set('display_errors','off');
          ini_set('log_errors','On');
        }
    }

    /*
     * 检测自定义全部变量并移除
    */
    public function unregisterGlobals()
    {
        if (ini_get('register_globals')) {
            $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
            foreach ($array as $value) {
                foreach ($GLOBALS[$value] as $key => $var) {
                    if ($var === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }
    /*
     * 配置数据库信息
    */
    public function setDbConfig()
    {
   	if($this->config['db']){
          define('DB_HOST',$this->config['db']['host']);
          define('DB_USER',$this->config['db']['username']);
          define('DB_NAME',$this->config['db']['dbname']);
          define('DB_PASS',$this->config['db']['password']);
        }
    }
    /*
      * 自动加载类
    */
    public function loadClass($className)
    {
        $classMap = $this->classMap();

        if (isset($classMap[$className])) {
            // 包含内核文件
            $file = $classMap[$className];
        } elseif (strpos($className, '\\') !== false) {
            // 包含应用（application目录）文件
            $file = APP_PATH . str_replace('\\', '/', $className) . '.php';
            if (!is_file($file)) {
                return;
            }
        } else {
            return;
        }

        include $file;     
    }

    /*
     * 内核文件命名空间映射关系
    */
    public function classMap()
    {    
      return [
           'quickphp\base\Controller' => CORE_PATH . '/base/Controller.php',
           'quickphp\base\Model' => CORE_PATH . '/base/Model.php',
           'quickphp\base\View' => CORE_PATH . '/base/View.php',
           'quickphp\db\Db' => CORE_PATH . '/db/Db.php',
           'quickphp\db\Sql' => CORE_PATH . '/db/Sql.php'
      ];
    }
}

