<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Order_model extends CI_Model{
  
  public function get_all_order($offset, $limit,$is_finished){
    $sql = "select h.house_name, o.* from t_house_info h, t_order o
            where h.house_id = o.house_id";
    if($is_finished){
      $sql .= " and o.is_finished = $is_finished";
    }
    $sql .= " limit $offset, $limit";
    return $this -> db -> query($sql) -> result();
  }

  public function get_all_order_count($is_finished){
    $sql = "select h.house_name, o.* from t_house_info h, t_order o
            where h.house_id = o.house_id";
    if($is_finished){
      $sql .= " and o.is_finished = $is_finished";
    }
    return $this -> db -> query($sql) -> num_rows();
  }

  public function get_order_detail($order_num){
    $sql = "select h.house_name,h.house_id, o.* from t_house_info h, t_order o
            where h.house_id = o.house_id and o.order_num = $order_num";
    return $this -> db -> query($sql) -> row();
  }







}
?>