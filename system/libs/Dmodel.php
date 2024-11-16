<?php 
class Dmodel{
  protected $db = array();
  public function __construct(){
    $connect = 'mysql:dbname=pdo_blog;host=localhost;'; //host co the la 112.366.288.155
    $user = 'root';
    $password = 'root';
    $this->db = new Database($connect, $user, $password);
  }

  
}
?>