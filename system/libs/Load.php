<?php
class Load{

  public function __construct(){
    // Constructor code here if needed
  }
  public function view($fileName, $data = false ){
    if($data == true){
      extract($data);
    }
    include "app/views/{$fileName}.php";
  }
  public function model($fileName){
    include "app/models/{$fileName}.php";
    return new $fileName();
  }

  
}