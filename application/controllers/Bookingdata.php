<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bookingdata extends CI_Controller {
	public function __construct(){
    	parent::__construct();
    	$this->load->model('bookingdataModel'); 
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');	
		$this->email->set_newline("\r\n");
  	}
  
  	public function index(){
  		if($this->session->userdata('status_admin') != "login"){
			redirect(base_url("Admin"));
		}
		$hasil['data'] = $this->bookingdataModel->view_booking();				
		$this->load->view('admin/data/data_booking', $hasil);
  	}
  
   public function edit($id){
    	$hasil_select['data_edit'] = $this->bookingdataModel->view_biaya($id);
    	echo json_encode($hasil_select);
  	}
    
    public function update(){
  		$id = $this->input->post('id');
		$data = array(
			"biaya_tambahan" => $this->input->post('biaya'),
			"ket_biaya_tambahan" => $this->input->post('ket')
		);
		
		$this->bookingdataModel->update($id,$data);
		echo "success";	
	}
  
  	public function cancel($id){
    	$data = array(
			"status_cancle" => 1
		);
		
		$this->bookingdataModel->cancel($id,$data);
		echo "success";	
  	} 

}