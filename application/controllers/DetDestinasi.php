<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DetDestinasi extends CI_Controller {
	public function __construct(){
    	parent::__construct();
    	$this->load->model('WisataModel'); 
		$this->load->helper(array('form', 'url')); 
  	}
  
    public function index($id){
 		$hasil['data'] = $this->WisataModel->view_wisata_byID($id);		
		$this->load->view('destinasi/detail-destinasi',$hasil);
	}
	
}