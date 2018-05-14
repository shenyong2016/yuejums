<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Welcome_model extends CI_Model{
  
  public function get_user($username, $password){
    return $this -> db -> get_where('t_user', array(
      'username' => $username,
      'password' => $password,
      'user_type' => 1
    )) -> row();
  }






}
?>