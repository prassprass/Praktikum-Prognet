<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PaketdataModel extends CI_Model {

  public function view_paket(){
  
	$this->db->select('*,((hotel.harga)+(wisata.harga))+(((hotel.harga)+(wisata.harga))*50/100) AS total_harga_paket ');
	$this->db->from('tbl_paket pp');
	$this->db->join('(SELECT p.id_paket, SUM(biaya_permalam*banyak_malam_hotel) as harga
						FROM tbl_paket p
						LEFT JOIN tbl_det_paket_hotel ph ON p.id_paket=ph.id_paket
						LEFT JOIN tbl_hotel h ON ph.id_hotel=h.id_hotel
						WHERE status_aktif_paket=1
						GROUP BY p.id_paket) AS hotel', 'pp.id_paket=hotel.id_paket');
	$this->db->join('(SELECT p.id_paket, SUM(harga_tiket) as harga
						FROM tbl_paket p
						LEFT JOIN tbl_det_paket_wisata pw ON p.id_paket=pw.id_paket
						LEFT JOIN tbl_wisata w ON pw.id_wisata=w.id_wisata
						WHERE status_aktif_paket=1
						GROUP BY p.id_paket) AS wisata','pp.id_paket=wisata.id_paket');
	$this->db->where('status_aktif_paket', 1);
	$query = $this->db->get()->result();
    return $query; 
  }
  
    public function view_paket_byID($id){

	$this->db->select('*');
	$this->db->from('tbl_paket p');
	$this->db->where('id_paket', $id);
	$query = $this->db->get()->result();
    return $query; 
  }
  
  
  public function save($data){    
		$this->db->insert('tbl_paket', $data); 
  }  
  
  public function delete($id,$data){
    $this->db->where('id_paket', $id);
    $this->db->update('tbl_paket', $data); 
  }
  
  
  public function update($id,$data){     
  
	$this->db->where('id_paket', $id);
    $this->db->update('tbl_paket', $data);
	
	}
	
  public function update_harga_paket($id,$data){     
  
	$this->db->where('id_paket', $id);
    $this->db->update('tbl_paket', $data);
	
	}
	
	
	
	
	
// HOTEL PAKET	

 public function view_paket_hotel($id){
		$this->db->select('*');   
		$this->db->from('tbl_det_paket_hotel ph');
		$this->db->join('tbl_paket p', 'ph.id_paket = p.id_paket');
		$this->db->join('tbl_hotel h', 'ph.id_hotel = h.id_hotel');
		$this->db->where('ph.id_paket', $id);
		$query = $this->db->get()->result();
		return $query; 
	} 
	
  public function delete_hotel($id){
    $this->db->where('id_det_hotel', $id);
    $this->db->delete('tbl_det_paket_hotel'); 
  }	

  public function view_hotel_aviable($id){

		$this->db->select('id_hotel');  
		$this->db->from('tbl_det_paket_hotel');
		$this->db->where('id_paket', $id);
		$ignore = $this->db->get()->result();
	

		$this->db->select('*');   
		$this->db->from('tbl_hotel ');		
		foreach ($ignore as $ignore){$this->db->where_not_in('id_hotel', $ignore->id_hotel);}
		$this->db->where('status_aktif', 1);
		$query = $this->db->get()->result();

		return $query;
  } 
  
  public function add_hotel($data){
    $this->db->insert('tbl_det_paket_hotel', $data);
  }	
  
  
  
  
  
  
  // WISATA PAKET	
  

 public function view_paket_wisata($id){
		$this->db->select('*');   
		$this->db->from('tbl_det_paket_wisata pw');
		$this->db->join('tbl_paket p', 'pw.id_paket = p.id_paket');
		$this->db->join('tbl_wisata w', 'pw.id_wisata = w.id_wisata');
		$this->db->where('pw.id_paket', $id);
		$query = $this->db->get()->result();
		return $query; 
	} 
	
  public function delete_wisata($id){
    $this->db->where('id_det_wisata', $id);
    $this->db->delete('tbl_det_paket_wisata'); 
  }	
  
  public function view_wisata_aviable($id){

		$this->db->select('id_wisata');  
		$this->db->from('tbl_det_paket_wisata');
		$this->db->where('id_paket', $id);
		$ignore = $this->db->get()->result();
	

		$this->db->select('*');   
		$this->db->from('tbl_wisata ');		
		foreach ($ignore as $ignore){$this->db->where_not_in('id_wisata', $ignore->id_wisata);}
		$query = $this->db->get()->result();

		return $query;
  } 
  
  public function add_wisata($data){
    $this->db->insert('tbl_det_paket_wisata', $data);
  }		
}