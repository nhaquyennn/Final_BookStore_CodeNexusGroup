<?php
class categorymodel extends Dmodel{
 
  public function __construct(){
    parent::__construct();
  }
  public function category($table_category_product){
    $sql = "select * from tbl_category_product order by id_category_product desc";
    return $this->db->select($sql);
  }
  public function categorybyId($table_category_product,$id){
    $sql = "select * from $table_category_product where id_category_product = :id  ";
    $data = array(':id' => $id);
    return $this->db->select($sql,$data);
  }

  public function insertcategory($table_category_product, $data)
  {
    return $this->db->insert($table_category_product, $data);
  }
  public function updatecategory($table_category_product, $data, $cond)
  {
    return $this->db->update($table_category_product, $data, $cond);
  }
  public function deletecategory($table_category_product, $cond)
  {
    return $this->db->delete($table_category_product, $cond);
  }
}

?>