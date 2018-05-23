<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class momentModel extends CI_Model {

  public function view_wisata(){

	$this->db->select('*');
	$this->db->from('tbl_moment m');
	$query = $this->db->get()->result();
    return $query; 
  } 

  public function save($data){    
		$this->db->insert('tbl_moment', $data); 
  }  

  public function view_id_moment($id){
	$this->db->select('*');
	$this->db->from('tbl_moment');
	$this->db->where('id_moment', $id);
	$query = $this->db->get()->row_array();
    return $query; 
  }

  
  public function update($id,$data){     
  
  	$this->db->where('id_moment', $id);
    $this->db->update('tbl_moment', $data);
	
	}
	
}