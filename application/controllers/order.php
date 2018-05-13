<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Order extends CI_Controller{
 
  // 订单管理
  public function index(){
    $this -> load -> view('order');
  }

 


}