<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pembayarandataModel extends CI_Model {

  public function view_pembayaran(){

	$this->db->select('*');
	$this->db->from('tbl_pembayaran p');
	$this->db->join('tbl_booking b', 'p.id_booking = b.id_booking');
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

  public function valid($id,$data){

	$this->db->where('id_pembayaran', $id);
    $this->db->update('tbl_pembayaran', $data);
  } 
  
}