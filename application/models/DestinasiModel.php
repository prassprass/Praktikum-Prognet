<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DestinasiModel extends CI_Model {

	public function view_wisata(){

		$this->db->select('*');
		$this->db->from('tbl_wisata w');
		$this->db->join('tbl_jenis_wisata jw', 'w.id_jenis_wisata = jw.id_jenis_wisata');
		$query = $this->db->get()->result();
		return $query; 
	}
  
	 public function get_total(){
		return $this->db->count_all("tbl_wisata");
	}

  public function get_filter($lokasi, $jenis){
		if(!$lokasi==0)$this->db->like('lokasi', $lokasi);
		if(!$jenis==0)$this->db->where('id_jenis_wisata', $jenis);
		$query=$this->db->get("tbl_wisata");
		return $query->num_rows();
	} 	
	
	public function get_current_page_records($limit, $start){
        $this->db->limit($limit, $start);
        $query = $this->db->get("tbl_wisata");
 
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
	
	 public function get_current_page_records_filter($limit, $start, $lokasi, $jenis){
        $this->db->limit($limit, $start);
		if(!$lokasi==0)$this->db->like('lokasi', $lokasi);
		if(!$jenis==0)$this->db->where('id_jenis_wisata', $jenis);
        $query = $this->db->get("tbl_wisata");
 
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
 	
}