<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Order extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this -> load -> model('house_model');
    $this -> load -> model('order_model');
  }

  // 订单管理
  public function index(){
    $this -> load -> view('order');
  }

  // 订单详情
  public function order_detail(){
    $this -> load -> view('order_detail');
  }

  // 获取订单list
  public function get_all_order(){
    $page = $this -> input -> get('page');
    $page_size = $this -> input -> get('pageSize');
    $is_finished = $this -> input -> get('isFinished');
    $order = $this -> order_model -> get_all_order(($page-1)*$page_size,$page_size,$is_finished);
    $order_count = $this -> order_model -> get_all_order_count($is_finished);
    echo json_encode(array(
      'order' => $order,
      'order_count' => $order_count
    ));
  }
 
  // 获取订单详情
  public function get_order_info(){
    $order_num = $this -> input -> get('orderNum');
    $order = $this -> order_model -> get_order_detail($order_num);
    echo json_encode($order);
  }



}