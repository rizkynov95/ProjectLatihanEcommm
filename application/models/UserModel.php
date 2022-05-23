<?php if ( ! defined('BASEPATH')) 
exit('No direct script accessallowed');
class UserModel extends CI_Model {

 public function get($username){
 $this->db->where('username', $username); // Untukmenambahkan Where Clause : username='$username'
 $result = $this->db->get('user')->row(); // Untukmengeksekusi dan mengambil data hasil query
 return $result;
 }
}