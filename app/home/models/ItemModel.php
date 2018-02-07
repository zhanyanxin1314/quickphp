<?php

namespace app\home\models;

use quickphp\base\Model;
use quickphp\db\Db;
use quickphp\db\Sql;
class ItemModel extends Model
{
   protected $table = 'item';


  public function search(){
      $sql = 'select * from ' . $this->table;
      $sth = Db::pdo()->prepare($sql);
      $sth->execute();
      return $sth->fetchAll();
  }
  
   /*
   *  添加数据
   */
   public function add1($data)
   {
      
       $this->add($data); 
   }

   /*
    *  查询mysql数据类型
   */
    public function getMdba()
    {
      return $this->where(["type = ?"], ['mydba'])->fetch();
    } 

}
