<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class House_model extends CI_Model {
  
  public function get_all_house($offset, $limit){
    $sql = "select * from t_house_info where is_delete = 0
            order by time desc limit $offset, $limit";
    return $this -> db -> query($sql) -> result();
  }

  public function get_all_house_count(){
    $sql = "select * from t_house_info where is_delete = 0 order by time desc";
    return $this -> db -> query($sql) -> num_rows();
  }

  public function update_house_by_house_id($house_id){    
    $sql = "update t_house_info set is_delete = 1 
            where house_id in ($house_id)";
    $query = $this -> db -> query($sql);
    if($query){
      return $this -> db -> affected_rows();
    }
  }

  public function save_house_info($village,$house_name,$house_size,$recommend,
  $build_area,$user_area,$price,$position,$address,$traffic,$detail,
  $note,$sale_type,$village_name,$house_size_name,$location_name,$house_type){
    $this -> db -> insert('t_house_info', array(
      'village_type' => $village,
      'house_name' => $house_name,
      'house_size' => $house_size_name,
      'house_size_val' => $house_size,
      'house_build_area' => $build_area,
      'house_user_area' => $user_area,
      'house_location' => $location_name,
      'house_address' => $address,
      'house_traffic' => $traffic,
      'house_details' => $detail,
      'house_note' => $note,
      'sale_type' => $sale_type,
      'village_name' => $village_name,
      'house_type' => $house_type,
      'house_recommened' => $recommend,
      'house_price' => $price,
      'house_lng_lat' => $position,
      'is_delete' => 0

    ));
    return $this -> db -> insert_id();
  }

  public function save_house_img($img_info){
    $this -> db -> insert('t_house_img', $img_info);
    return $this -> db -> affected_rows();
  }

  public function get_house_by_house_id($house_id){
    return $this -> db -> get_where('t_house_info', array(
      'house_id' => $house_id
    )) -> row();
  }

  public function get_house_img_by_house_id($house_id){
    return $this -> db -> get_where('t_house_img', array(
      'house_id' => $house_id
    )) -> result();
  }









}
