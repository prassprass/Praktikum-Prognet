<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HotelModel extends CI_Model {

  public function view_hotel(){

	$this->db->select('*');
	$this->db->from('tbl_hotel');;
	$this->db->where('status_aktif', 1);
	$query = $this->db->get()->result();
    return $query; 
  }
  
  public function save($data){    
		$this->db->insert('tbl_hotel', $data); 
  }  
  
  public function delete($id,$data){
    $this->db->where('id_hotel', $id);
    $this->db->update('tbl_hotel', $data); 
  }

  public function view_id_hotel($id){

	// $sql = "SE * from tbl_hotel where id_hotel='$id'";
	//$query= $this->db->query($sql);
	
	$this->db->select('*');
	$this->db->from('tbl_hotel');;
	$this->db->where('id_hotel', $id);
	$query = $this->db->get()->row_array();
    return $query; 
  }
  
    public function update($id,$data){     
  
	$this->db->where('id_hotel', $id);
    $this->db->update('tbl_hotel', $data);
	
	}
	
}