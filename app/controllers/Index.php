<?php
class index extends Dcontroller {
  public $load;
  
  public function __construct() {
      $data = array();
      parent::__construct();
      $this->load = new Load(); // Khởi tạo Load
  }

  public function index() {
    $this->homepage();
  }

  public function homepage() {
    $this->load->view('header');
    $this->load->view('home');
    $this->load->view('footer');
  }

  public function notfound() {
    $this->load->view('header');
    $this->load->view('404'); 
    $this->load->view('footer');
  } 
}
?>