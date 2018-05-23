<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LaporanModel extends CI_Model {

  public function view_booking(){

	$this->db->select('*');
	$this->db->from('tbl_booking b');
	$this->db->join('tbl_user u', 'b.id_user = u.id_user');
	$this->db->join('tbl_paket p', 'b.id_paket = p.id_paket');
	$this->db->where('status_pembayaran', 1);
	$this->db->order_by('tgl_booking', "DESC");
	//$this->db->join('tbl_pembayaran pb', 'pb.id_booking = b.id_booking');
	$query = $this->db->get()->result();
    return $query; 
  } 	

    public function cari_pemasukan($data){

	$this->db->select('*');
	$this->db->from('tbl_booking b');
	$this->db->join('tbl_user u', 'b.id_user = u.id_user');
	$this->db->join('tbl_paket p', 'b.id_paket = p.id_paket');
	$this->db->where($data);
	$this->db->order_by('tgl_booking', "DESC");
	//$this->db->join('tbl_pembayaran pb', 'pb.id_booking = b.id_booking');
	$query = $this->db->get()->result();
    return $query; 
  } 
 
  public function view_pembatalan(){

	$this->db->select('*');
	$this->db->from('tbl_booking b');
	$this->db->join('tbl_user u', 'b.id_user = u.id_user');
	$this->db->join('tbl_paket p', 'b.id_paket = p.id_paket');
	$this->db->where('status_cancle', 1);
	$this->db->order_by('tgl_booking', "DESC");
	$query = $this->db->get()->result();
    return $query; 
  }
  
  public function cari_pembatalan($data){

	$this->db->select('*');
	$this->db->from('tbl_booking b');
	$this->db->join('tbl_user u', 'b.id_user = u.id_user');
	$this->db->join('tbl_paket p', 'b.id_paket = p.id_paket');
	$this->db->where($data);
	$this->db->order_by('tgl_booking', "DESC");
	$query = $this->db->get()->result();
    return $query; 
  } 
  
   public function view_paket(){

	$this->db->select('*, count(b.id_paket) as banyak_perjalanan, sum(banyak_traveler) as total_traveler');
	$this->db->from('tbl_paket p');
	$this->db->join('tbl_booking b', 'b.id_paket = p.id_paket');
	$this->db->where('status_pembayaran', 1);
	$this->db->group_by('b.id_paket');
	$this->db->order_by('count(b.id_paket)', "DESC");
	$query = $this->db->get()->result();
    return $query; 
  }
  
   public function cari_paket($data){

	$this->db->select('*, count(b.id_paket) as banyak_perjalanan, sum(banyak_traveler) as total_traveler');
	$this->db->from('tbl_paket p');
	$this->db->join('tbl_booking b', 'b.id_paket = p.id_paket');
	$this->db->where($data);
	$this->db->group_by('b.id_paket');
	$this->db->order_by('count(b.id_paket)', "DESC");
	$query = $this->db->get()->result();
    return $query; 
  } 
  
}