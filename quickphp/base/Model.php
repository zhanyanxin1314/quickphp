<?php

namespace quickphp\base;

use quickphp\db\Sql;

class Model extends Sql
{
    protected $model;

    /*
     * 构造函数  初始化熟悉
    */	
    public function __construct()
    {
	if(!$this->table) {

	   $this->model = get_class($this);

           $this->model = substr($this->model,0,-5);

           $this->table = strtolower($this->model);

        }
    }
}
