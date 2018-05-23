<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PembayaranModel extends CI_Model {

  
  public function cari_booking($id){
		$this->db->select('*');
		$this->db->from('tbl_booking b');
		$this->db->join('tbl_user u', 'b.id_user = u.id_user');
		$this->db->where('id_booking', $id);
		$query = $this->db->get()->result();
		return $query; 
	} 
  public function pembayaran($data){
    $this->db->insert('tbl_pembayaran', $data);
  }	
  
  public function status_pembayaran($id,$data){
   	$this->db->where('id_booking', $id);
    $this->db->update('tbl_booking', $data);
  }	
	
}