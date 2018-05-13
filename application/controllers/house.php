<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class House extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this -> load -> model('house_model');
  }

  // 查询所有房屋
	public function get_all_house(){
    $page = $this -> input -> get('page');
    $page_size = $this -> input -> get('pageSize');
    $house = $this -> house_model -> get_all_house(($page-1)*$page_size,$page_size);
    $house_count = $this -> house_model -> get_all_house_count();  
    echo json_encode(array(
      'house' => $house,
      'house_count' => $house_count
    ));
  }

  // 删除房屋
  public function delete_house(){
    $house_id = $this -> input -> get('houseId');
    $row = $this -> house_model -> update_house_by_house_id($house_id);
    if($row > 0){
      echo 'success';
    }else{
      echo 'fail';
    }
  }

   // 编辑房源
   public function edit_house(){
    $this -> load -> view('edit_house');
  }

	
 
  




}
