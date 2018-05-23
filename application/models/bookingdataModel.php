<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class bookingdataModel extends CI_Model {

  public function view_booking(){

	$this->db->select('*');
	$this->db->from('tbl_booking b');
	$this->db->join('tbl_user u', 'b.id_user = u.id_user');
	$this->db->join('tbl_paket p', 'b.id_paket = p.id_paket');
	//$this->db->join('tbl_pembayaran pb', 'pb.id_booking = b.id_booking');
	$query = $this->db->get()->result();
    return $query; 
  } 	
  
  public function view_biaya($id){

	$this->db->select('*');
	$this->db->from('tbl_booking b');
	$this->db->where('id_booking',$id);
	$query = $this->db->get()->row_array();
    return $query; 
  } 
  public function update($id,$data){

	$this->db->where('id_booking', $id);
    $this->db->update('tbl_booking', $data);
  } 

  public function cancel($id,$data){

	$this->db->where('id_booking', $id);
    $this->db->update('tbl_booking', $data);
  } 
  
}