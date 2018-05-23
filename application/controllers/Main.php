<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('Home'); 
    $this->load->helper(array('form', 'url')); 
  }
  
  public function index(){
    $hasil['data_wisata']       = $this->Home->destinasi_limit();		
  	$hasil['data_paket']         = $this->Home->view_paket();		
  	$hasil['data_moment']        = $this->Home->view_moment();		
  	$hasil['data_jenis_wisata']  = $this->Home->view_jenis_wisata();		
    $this->load->view('home/index',$hasil);
  }
  
}