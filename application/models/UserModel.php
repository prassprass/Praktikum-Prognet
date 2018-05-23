<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model {

  
  
  public function login($where){
	$hasil=$this->db->get_where('tbl_user', $where);
	return $hasil;
  }
  
  public function daftar($data){    
		$this->db->insert('tbl_user', $data); 
  }  
  
    public function view_booking($id){

	$this->db->select('*');
	$this->db->from('tbl_booking b');
	$this->db->join('tbl_user u', 'b.id_user = u.id_user');
	$this->db->join('tbl_paket p', 'b.id_paket = p.id_paket');
	$this->db->where('b.id_user', $id);
	$query = $this->db->get()->result();
    return $query; 
  } 
  
}