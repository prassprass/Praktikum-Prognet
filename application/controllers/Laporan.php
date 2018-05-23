<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public function __construct(){
    	parent::__construct();
		$this->load->model('LaporanModel'); 
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');	
		$this->email->set_newline("\r\n");
  	}
  
  	public function index(){
  		if($this->session->userdata('status_admin') != "login"){
			redirect(base_url("Admin"));
		}
		$hasil['data'] = $this->LaporanModel->view_booking();				
		$hasil['data_pembatalan'] = $this->LaporanModel->view_pembatalan();				
		$hasil['data_paket'] = $this->LaporanModel->view_paket();				
		$this->load->view('admin/data/data_laporan', $hasil);
  	}
  
    public function cari_pemasukan(){
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');
	  	$data = array(
			'tgl_traveling >=' 	=> $awal,
			'tgl_traveling <= ' => $akhir,
			'status_pembayaran' => 1
		);			
		$hasil['awal_pemasukan'] 	= $awal;
		$hasil['akhir_pemasukan'] 	= $akhir;
		$hasil['data_pembatalan'] 	= $this->LaporanModel->view_pembatalan();				
		$hasil['data_paket'] 		= $this->LaporanModel->view_paket();	
		$hasil['data'] 				= $this->LaporanModel->cari_pemasukan($data);				
		$this->load->view('admin/data/data_laporan', $hasil);
	}   

	public function cari_pembatalan(){
		$awal_pembatalan 	= $this->input->post('awal_pembatalan');
		$akhir_pembatalan 	= $this->input->post('akhir_pembatalan');
		$data = array(
			'tgl_traveling >=' 	=> $awal_pembatalan,
			'tgl_traveling <= ' => $akhir_pembatalan,
			'status_cancle' 	=> 1
		);
		$hasil['awal_pembatalan'] 	= $awal_pembatalan;
		$hasil['akhir_pembatalan'] 	= $akhir_pembatalan;
		$hasil['data'] 				= $this->LaporanModel->view_booking();				
		$hasil['data_paket'] 		= $this->LaporanModel->view_paket();
		$hasil['data_pembatalan'] 	= $this->LaporanModel->cari_pembatalan($data);				
		$this->load->view('admin/data/data_laporan', $hasil);
	}    
  
	public function cari_paket(){
		$awal_paket = $this->input->post('awal_paket');
		$akhir_paket = $this->input->post('akhir_paket');
		$data = array(
			'tgl_traveling >=' 	=> $awal_paket,
			'tgl_traveling <= ' => $akhir_paket,
			'status_pembayaran' => 1
		);
		$hasil['awal_paket'] 		= $awal_paket;
		$hasil['akhir_paket'] 		= $akhir_paket;
		$hasil['data'] 				= $this->LaporanModel->view_booking();				
		$hasil['data_pembatalan'] 	= $this->LaporanModel->view_pembatalan();				
		$hasil['data_paket'] 		= $this->LaporanModel->cari_paket($data);				
		$this->load->view('admin/data/data_laporan', $hasil);
	}
   
}