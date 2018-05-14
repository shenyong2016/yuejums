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

  //房源详情
  public function house_detail(){
    $this -> load -> view('house_detail');
  }
  // 获取房源详情
  public function get_house_detail(){
    $house_id = $this -> input -> get('houseId');
    $house = $this -> house_model -> get_house_by_house_id($house_id);
    $house_img = $this -> house_model -> get_house_img_by_house_id($house_id);
    
    echo json_encode(array(
      'house' => $house,
      'house_img' => $house_img
    ));
  }



  
  //提交房源
  public function commit_house_info(){
    $village = $this -> input -> get('village');
    $house_name = $this -> input -> get('houseName');
    $house_size = $this -> input -> get('houseSize');
    $build_area = $this -> input -> get('buildArea');
    $user_area = $this -> input -> get('userArea');
    $price = $this -> input -> get('price');
    $position = $this -> input -> get('position');
    $address = $this -> input -> get('address');
    $traffic = $this -> input -> get('traffic');
    $detail = $this -> input -> get('detail');
    $note = $this -> input -> get('note');
    $house_img_list = $this -> input -> get('houseImgList');
    $sale_type = $this -> input -> get('saleTypeVal');
    $village_name = $this -> input -> get('villageName');
    $house_size_name = $this -> input -> get('houseSizeName');
    $location_name = $this -> input -> get('locationName');
    $house_type = $this -> input -> get('houseType');
    $house_id = $this -> input -> get('houseId');
    $recommend = $this -> input -> get('recommendVal');
    $house_img = json_decode($house_img_list);
    $img_url = 'yuejums/';//图片保存到yuejums里
    if($house_id){
      $u_row = $this -> house_model -> update_house_info($house_id,$village,$house_name,$house_size,$recommend,
                      $build_area,$user_area,$price,$position,$address,$traffic,$detail,
                      $note,$sale_type,$village_name,$house_size_name,$location_name,$house_type);
      $d_row = $this -> house_model -> delete_house_img($house_id);
      foreach($house_img as $index => $item){
        $img_info = array(
          'is_main' => $index == 0 ? 1 : 0,
          'img_src' => $img_url.$item,
          'house_id' => $house_id
        );
        $s_row = $this -> house_model -> save_house_img($img_info);
      }
      if($s_row > 0){
        echo 'update';
      }else{
        echo 'no_update';
      }

    }else{
      $insert_id = $this -> house_model -> save_house_info($village,$house_name,$house_size,$recommend,
                      $build_area,$user_area,$price,$position,$address,$traffic,$detail,
                      $note,$sale_type,$village_name,$house_size_name,$location_name,$house_type);
      
      if($insert_id){
        foreach($house_img as $index => $item){
          $img_info = array(
            'is_main' => $index == 0 ? 1 : 0,
            'img_src' => $img_url.$item,
            'house_id' => $insert_id
          );
          $row = $this -> house_model -> save_house_img($img_info);
        }
        if($row > 0){
          echo 'success';
        }else{
          echo 'fail';
        }
      }
    }
    
    
  } 

	
 
  




}
