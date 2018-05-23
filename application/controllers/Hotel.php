<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel extends CI_Controller {
    public function __construct(){
    	parent::__construct();
        $this->load->model('HotelModel'); 
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');	
		$this->email->set_newline("\r\n");
  	}
	
	public function index(){
  		if($this->session->userdata('status_admin') != "login"){
			redirect(base_url("Admin"));
		}
		
		$hasil['data'] = $this->HotelModel->view_hotel();
		$this->load->view('admin/data/data_hotel', $hasil);
  	}
  
  	public function load_data(){
   		$hasil['data'] = $this->HotelModel->view_hotel();
		echo json_encode($hasil); 
  	}
   
  	public function tambah_hotel(){
  		$data = array(
			"nama_hotel" 		=> $this->input->post('nama'),
			"alamat_hotel" 		=> $this->input->post('alamat'),
			"tlpn_hotel" 		=> $this->input->post('tlpn'),
			"biaya_permalam" 	=> $this->input->post('biaya'),
			"status_aktif" 		=> 1
		);
						
		$this->HotelModel->save($data); 
		echo "success";	
	  				
	}
	
	public function edit($id){
        $hasil_select['data_edit'] = $this->HotelModel->view_id_hotel($id);
    	echo json_encode($hasil_select);
  	}

  	public function update(){
  		$id = $this->input->post('idED');
		$data = array(
			"nama_hotel" => $this->input->post('namaED'),
			"alamat_hotel" => $this->input->post('alamatED'),
			"tlpn_hotel" => $this->input->post('tlpnED'),
			"biaya_permalam" => $this->input->post('biayaED')
		);
				
		$this->HotelModel->update($id,$data);
		echo "success";	
  	}
 
 	public function delete(){
 		$id = $this->input->post('id');
 		$data = array(
			"status_aktif" => 0
		);
    $this->HotelModel->delete($id,$data); 
	echo "success";
  }
  
}