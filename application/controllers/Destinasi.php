<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Destinasi extends CI_Controller {
	public function __construct(){
    	parent::__construct();
        $this->load->model('DestinasiModel'); 
		$this->load->helper(array('form', 'url')); 
		$this->load->library('pagination');
  	}
  
  	public function index(){
		if(empty($this->input->post('lokasi'))){
			$lokasi=0;
		}
		else{
			$lokasi=$this->input->post('lokasi');
		}
		if(empty($this->input->post('jenis'))){
			$jenis=0;
		}
		else{
			$jenis=$this->input->post('jenis');
		}
		
		if($this->input->post('cari')){
			$total_records = $this->DestinasiModel->get_filter($lokasi, $jenis);
		}
		else{
			$total_records = $this->DestinasiModel->get_total();
		}
		
    	// init params
    	$params = array();
    	$limit_per_page = 6;
    	$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
        if ($total_records > 0) {
            // get current page records
			if($this->input->post('cari')){
				$params["data"] = $this->DestinasiModel->get_current_page_records_filter($limit_per_page, $start_index, $lokasi, $jenis);	
			}
			else{
				$params["data"] = $this->DestinasiModel->get_current_page_records($limit_per_page, $start_index);
			}
			
            $config['base_url'] 	= base_url().'destinasi/index';
            $config['total_rows'] 	= $total_records;
            $config['per_page'] 	= $limit_per_page;
            $config["uri_segment"] 	= 3;

			//bootstrap class
			$config['first_link']       = 'First';
			$config['last_link']        = 'Last';
			$config['next_link']        = 'Next';
			$config['prev_link']        = 'Prev';
			$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
			$config['full_tag_close']   = '</ul></nav></div>';
			$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close']    = '</span></li>';
			$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close']  = '</span>Next</li>';
			$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close']  = '</span></li>';
			 
            $this->pagination->initialize($config);
             
            // build paging links
            $params["links"] = $this->pagination->create_links();
        }
         
    	$this->load->view('destinasi/destinasi', $params);
	}
	
}