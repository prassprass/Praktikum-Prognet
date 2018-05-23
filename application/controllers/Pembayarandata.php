<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembayarandata extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('pembayarandataModel'); 
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');	
		$this->email->set_newline("\r\n");
	}
  
	public function index(){
  		if($this->session->userdata('status_admin') != "login"){
			redirect(base_url("Admin"));
		}
		$hasil['data'] = $this->pembayarandataModel->view_pembayaran();				
		$this->load->view('admin/data/data_pembayaran', $hasil);
	}
  
	public function valid($id){
    	$data = array(
			"status_valid" => 1
		);	
		$this->pembayarandataModel->valid($id,$data);
		echo "success";	
	}
   
}