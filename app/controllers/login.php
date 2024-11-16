<?php
class login extends Dcontroller {
  public $load;
  
  public function __construct() {
      $message = array();
      // $message = array();
      $data = array();
      Session::checkSession();
      parent::__construct();
      // $this->load = new Load(); // Khởi tạo Load
  }

  public function index() {
    $this->login();
  }

  public function login() {
    $this->load->view('header');
    Session::init();
    if(Session::get('login') == true){
      header("Location:".BASE_URL."/login/dashboard");
    }
    $this->load->view('cpanel/login');
    $this->load->view('footer');
  }

  public function dashboard() {
    
    
    // Session::checkSession();
    $this->load->view('cpanel/header');
    $this->load->view('cpanel/dashboard');
    $this->load->view('cpanel/footer');
    
  }
  public function authentication_login(){
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Mật khẩu phải là MD5

    $table_admin = 'tbl_admin';
    $loginmodel = $this->load->model('loginmodel');

    $count = $loginmodel->login($table_admin, $username, $password);

    // $count = $loginmodel->login($table_admin, $username, $password);

    if($count == 0) {

      $message['msg'] = 'Tài khoản hoặc mật khẩu không đúng';
      header("Location:".BASE_URL."/login");
    } 
    else {

      $result = $loginmodel->getLogin($table_admin, $username, $password);

      Session::init();
      Session::set('login', true);
      Session::set('username', $result[0]['username']);
      Session::set('admin_id', $result[0]['id']);
      header("Location:".BASE_URL."/login/dashboard");
    }

  }

  public function logout(){
    Session::init();
    Session::destroy();
    header('Location:'.BASE_URL.'/login');
  }
}
?>