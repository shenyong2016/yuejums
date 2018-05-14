<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this -> load -> model('welcome_model');
  }
  // 登录
  public function login(){
    $this -> load -> view('login');
  }

  // 登录验证
  public function check_login(){
    $username = $this -> input -> post('username');
    $password = $this -> input -> post('password');
    $check_user = $this -> welcome_model -> get_user($username, $password);
    if($check_user){
      $this -> session -> set_userdata('loginedUser', $check_user);
      echo 'success';
    }else{
      echo 'fail';
    }
  }

  // 用户注销
  public function logout(){
    $this -> session -> unset_userdata('loginedUser');
    echo 'success';
  }



  // 房源管理
	public function index(){
		$this -> load -> view('house');
  }
 
  // 上传图片
  public function upload_img(){
    $config['upload_path'] = './images/';//设置上传路径
    $config['allowed_types'] = 'gif|jpg|png';//设置上传文件的格式
    $config['max_size'] = '3072';//设置文件的大小
    $config['file_name'] = date("YmdHis") . '_' . rand(10000,99999);//设置文件的文件名
    $this->load->library('upload', $config);
    $this -> upload -> do_upload('img');//表单里的自定义属性值
    $upload_data = $this -> upload -> data();

    if($upload_data['file_size'] > 0){
        $photo_url = 'images/' . $upload_data['file_name'];
        echo $photo_url;
      }
  }
  // 删除图片
  public function delete_img(){
    $img_src = $this -> input -> get('imgSrc');
    if(file_exists($img_src)){
        unlink($img_src);
        echo 'success';
    }
  }
  




}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */