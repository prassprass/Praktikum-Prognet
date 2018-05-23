<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DetPaket extends CI_Controller {
	public function __construct(){
    	parent::__construct();
    	$this->load->model('PaketdataModel'); 
		$this->load->helper(array('form', 'url')); 
  	}
  
  	public function index($id){
 		$hasil['data'] = $this->PaketdataModel->view_paket_byID($id);
		$hasil['data_hotel'] = $this->PaketdataModel->view_paket_hotel($id);	
		$hasil['data_wisata'] = $this->PaketdataModel->view_paket_wisata($id);		
		$hasil['data_wisata_foto'] = $this->PaketdataModel->view_paket_wisata($id);		
		$this->load->view('paket/detail-paket',$hasil);
	}
	
}