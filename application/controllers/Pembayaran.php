<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembayaran extends CI_Controller {
	public function __construct(){
    	parent::__construct();
        $this->load->model('PembayaranModel'); 
		$this->load->helper(array('form', 'url')); 
	}
  
	public function index(){
    	$this->load->view('pembayaran/pembayaran');
	}
	
	public function cari_booking($id){
		$hasil['data']=$this->PembayaranModel->cari_booking($id);
		echo json_encode($hasil); 
	}	
	
	public function pembayaran(){
  		$config['upload_path']          = './images/Pembayaran';
		$config['allowed_types']        = 'jpg|png';
		$this->load->library('upload', $config);
 		if ( ! $this->upload->do_upload('bukti')){
			$error = $this->upload->display_errors();
			echo $error;
		}
		else{
			//dapatkan data file yg d upload
			$upload_data = $this->upload->data();
 
			//dapatkan nama file
			$image = $upload_data['file_name'];
 
			$data = array(
				"id_booking" => $this->input->post('id_book'),
				"atas_nama_pengirim" => $this->input->post('atas_nama'),
				"bukti_transaksi" => $this->input->post('bukti'),
				"bukti_transaksi" => $image,				
				"tgl_upload_bukti" => date("Y-m-d"),
				"status_valid" =>0
			);
				
			$status = array(
				"status_pembayaran" => 0
			);	
								
			$this->PembayaranModel->pembayaran($data); 
			$this->PembayaranModel->status_pembayaran($this->input->post('id_book'),$status); 
			echo "success";	
	  	}
	}
}