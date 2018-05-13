<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class House_model extends CI_Model {
  
  public function get_all_house($offset, $limit){
    $sql = "select * from t_house_info where is_delete = 0 limit $offset, $limit";
    return $this -> db -> query($sql) -> result();
  }

  public function get_all_house_count(){
    $sql = "select * from t_house_info where is_delete = 0";
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




}
