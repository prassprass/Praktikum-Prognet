<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Moment extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('momentModel'); 
		$this->load->helper(array('form', 'url')); 
  	}
  
  public function index(){
		$hasil['data'] = $this->momentModel->view_wisata();		
		$this->load->view('moment/moment',$hasil);
	}
	
}