<?php

namespace app\home\controllers;

use quickphp\base\Controller;
use app\home\models\ItemModel;

class ItemController extends Controller
{
  
  public function index()
  {
        $item = new ItemModel();
        $info = $item->search();
        $this->render();  
  }

   public function editor()
   {
      if($_POST) {
         $data['item_name'] = $_POST['content'];
         $data['type'] = 'mydba';
         $item = new ItemModel();
          $item->add1($data);       
      } else {
        $this->render();
      }
   }
}
