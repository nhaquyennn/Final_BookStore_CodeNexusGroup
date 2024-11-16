<?php
class category extends Dcontroller{
  
  public function __construct(){
      $data =array();
      $message = array();
      parent::__construct();
      $this->load = new Load(); // Khởi tạo Load
  }
  public function list_category(){
      $this->load->view('header');

      $categorymodel = $this->load->model('categorymodel'); 
      $table_category_product = 'tbl_category_product';
      $data['category'] = $categorymodel->category($table_category_product);
      $this->load->view('category', $data);

      $this->load->view('footer');
  }
  public function catebyid(){
    $this->load->view('header');
    $categorymodel = $this->load->model('categorymodel'); 
    $id =1 ;
    $table_category_product = 'tbl_category_product';
    $data['categorybyid'] = $categorymodel->categorybyid($table_category_product,$id);
    $this->load->view('categorybyid', $data);
    $this->load->view('footer');
  }

  public function insertcategory(){
    $categorymodel = $this->load->model('categorymodel'); 

    // $id = 2 ;
    $table_category_product = 'tbl_category_product';

    $title = $_POST['title_category_product'];
    $desc = $_POST['desc_category_product'];

    $data = array(
      'title_category_product' => $title,
      'desc_category_product' => $desc
    );
    
    $resutl = $categorymodel->insertcategory($table_category_product, $data);
    if($resutl == 1){
      $message['msg'] = "Thêm dữ liệu thành công";
    }else{
      $message['msg'] = "Thêm dữ liệu thất bại";
    }
    $this->load->view('addcategory', $message);
  }
  public function addcategory(){
    $this->load->view('header');
    $this->load->view('addcategory');
    $this->load->view('footer');
  }
  
  public function updatecategory(){
    $categorymodel = $this->load->model('categorymodel'); 
    $table_category_product = 'tbl_category_product';
    $id = 2;
    // $title = 'Danh mục sản phẩm 2';
    // $desc = 'Mo ta sản phẩm 2';
    $cond = "id_category_product = $id";
    $data = array(
      'title_category_product' => 'Laptop',
      'desc_category_product' => 'Laptop ASUS Zell 2021',
    );
    $resutl = $categorymodel->updatecategory($table_category_product, $data, $cond);
    if($resutl == 1){
      echo "Cập nhật dữ liệu thành công";
    }else{
      echo "Cập nhật dữ liệu thất bại";
    }
  }
  public function deletecategory(){
    $categorymodel = $this->load->model('categorymodel'); 
    $table_category_product = 'tbl_category_product';
    $cond = "id_category_product = 2";
    $resutl = $categorymodel->deletecategory($table_category_product, $cond);
    if($resutl == 1){
      echo "Xóa dữ liệu thành công";
    }else{
      echo "Xóa dữ liệu thất bại";
    }
  }
  
}

?>