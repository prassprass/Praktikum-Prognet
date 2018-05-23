<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Model {


  public function destinasi_limit(){
	$this->db->select('*');
	$this->db->from('tbl_wisata w');
	$this->db->join('tbl_jenis_wisata jw', 'w.id_jenis_wisata = jw.id_jenis_wisata');
	$this->db->order_by('rand()');
	$this->db->limit(4);
	$query = $this->db->get()->result();
    return $query; 
  }
  public function view_paket(){

	$this->db->select('*');
	$this->db->from('tbl_paket p');
	$this->db->where('status_aktif_paket', 1);
	$this->db->limit(3);
	$query = $this->db->get()->result();
    return $query; 
  }
  
   public function view_moment(){

	$this->db->select('*');
	$this->db->from('tbl_moment');
	//$this->db->where('status_aktif_paket', 1);
	$this->db->order_by('tanggal_moment','desc');
	$this->db->limit(2);
	$query = $this->db->get()->result();
    return $query; 
  }
  
   public function view_jenis_wisata(){

	$this->db->select('*');
	$this->db->from('tbl_jenis_wisata');
	$query = $this->db->get()->result();
    return $query; 
  } 
}