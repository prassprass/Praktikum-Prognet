<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WisataModel extends CI_Model {

  public function view_wisata(){

	$this->db->select('*');
	$this->db->from('tbl_wisata w');;
	$this->db->join('tbl_jenis_wisata jw', 'w.id_jenis_wisata = jw.id_jenis_wisata');
	$query = $this->db->get()->result();
    return $query; 
  }
  
    public function view_wisata_byID($id){

	$this->db->select('*');
	$this->db->from('tbl_wisata w');;
	$this->db->join('tbl_jenis_wisata jw', 'w.id_jenis_wisata = jw.id_jenis_wisata');
	$this->db->where('id_wisata',$id);
	$query = $this->db->get()->result();
    return $query; 
  }
  
    public function jenis_wisata(){

	$this->db->select('*');
	$this->db->from('tbl_jenis_wisata');
	$query = $this->db->get()->result();
    return $query; 
  }
  
  public function savejenis($data){    
		$this->db->insert('tbl_jenis_wisata', $data); 
  }  

  public function save($data){    
		$this->db->insert('tbl_wisata', $data); 
  }  
  
  public function delete($id,$data){
    $this->db->where('id_hotel', $id);
    $this->db->update('tbl_hotel', $data); 
  }

  public function view_id_wisata($id){

	
	$this->db->select('*');
	$this->db->from('tbl_wisata');;
	$this->db->where('id_wisata', $id);
	$query = $this->db->get()->row_array();
    return $query; 
  }
  
    public function update($id,$data){     
  
	$this->db->where('id_wisata', $id);
    $this->db->update('tbl_wisata', $data);
	
	}
	
}