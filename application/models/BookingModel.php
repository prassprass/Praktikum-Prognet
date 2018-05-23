<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BookingModel extends CI_Model {

  public function harga($id){

	$this->db->select('harga_paket');
	$this->db->from('tbl_paket');
	$this->db->where('id_paket', $id);
	$query = $this->db->get()->result();
    return $query; 
  }
  
  public function get_total(){
		$this->db->where('status_aktif_paket', 1);
		$query=$this->db->get("tbl_paket");
		return $query->num_rows();
	} 
	
  public function get_filter($hari, $harga){
		$this->db->where('status_aktif_paket', 1);
		if(!$hari==0)$this->db->where('banyak_hari', $hari);
		$this->db->where('harga_paket <', $harga);
		$query=$this->db->get("tbl_paket");
		return $query->num_rows();
	} 	
	
  public function get_current_page_records($limit, $start){
        $this->db->limit($limit, $start);
		$this->db->where('status_aktif_paket', 1);
        $query = $this->db->get("tbl_paket");
 
        if ($query->num_rows() > 0) 
        {
            foreach ($query->result() as $row) 
            {
                $data[] = $row;
            }
             
            return $data;
        }
 
        return false;
    }

	public function booking($data){
		$this->db->insert('tbl_booking', $data); 
	} 
	
}