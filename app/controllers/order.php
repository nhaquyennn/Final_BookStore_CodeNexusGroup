<?php

class order extends Dcontroller{
  public function __construct(){
    Session::checkSession();
    parent::__construct();
  }
 public function index(){
  return $this->order();
 }
  public function order(){
    $this->load->view('cpanel/header');
    $this->load->view('cpanel/menu');
    $this->load->view('cpanel/order/order');
    $this->load->view('cpanel/footer');
  }
  public function add_order(){
    
    $this->load->view('cpanel/header');
    $this->load->view('cpanel/menu');
    $this->load->view('cpanel/order/add_order');
    $this->load->view('cpanel/footer');

  }

  public function delete_order(){
    $this->load->view('cpanel/header');
    $this->load->view('cpanel/menu');
    $this->load->view('cpanel/order/delete_order');
    $this->load->view('cpanel/footer');
  }
  
  public function insert_order(){
    $this->load->view('cpanel/header');
    $this->load->view('cpanel/menu');
    $this->load->view('cpanel/order/insert_order');
    $this->load->view('cpanel/footer');
  }

}


?>