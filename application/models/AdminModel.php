<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminModel extends CI_Model {


  public function view_content(){
  
	$param = array(
		"status_pembayaran" => 1,
		"tgl_traveling >" => date("Y-m-d")
	);
  
	$this->db->select('*');
	$this->db->from('tbl_booking b');
	$this->db->join('tbl_user u', 'b.id_user = u.id_user');
	$this->db->join('tbl_paket p', 'b.id_paket = p.id_paket');
	$this->db->where($param);
	$this->db->order_by('tgl_booking', "ASC");
	$this->db->limit(10);
	$query = $this->db->get()->result();
    return $query; 
  }
  
    public function view_gallery(){
		return $this->db->get('tbl_gallery')->result();
  }
  
  
  public function login($where){
	$hasil=$this->db->get_where('tbl_admin', $where);
	return $hasil;
  }
  
  public function save($data){    
    $this->db->insert('tbl_content', $data); 
  }  
  
  
  public function edit($user_id,$data){
    $this->db->where('user_id', $user_id);
    $this->db->update('user', $data); 
  }

 
  public function delete($user_id){
    $this->db->where('user_id', $user_id);
    $this->db->delete('user'); // Untuk mengeksekusi perintah delete data
  }

}