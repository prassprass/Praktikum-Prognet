<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paket extends CI_Controller {
	public function __construct(){
    	parent::__construct();
		$this->load->model('PaketModel'); 
		$this->load->helper(array('form', 'url')); 
		$this->load->library('pagination');
	}
  
	public function index(){
		if(empty($this->input->post('hari'))){
			$hari=0;
		}
		else{
			$hari=$this->input->post('hari');
		}
		if(empty($this->input->post('harga'))){
			$harga=99999999;
		}
		else{
			$harga=$this->input->post('harga');
		}
		
		//jika cari pada halam index ditekan atau tidak
		if($this->input->post('cari')){
			$total_records = $this->PaketModel->get_filter($hari, $harga);
		}
		else{
			$total_records = $this->PaketModel->get_total();
		}

	    // init params
        $params = array();
        $limit_per_page = 3;
        $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 
        if ($total_records > 0) {
            // get current page records
			if($this->input->post('cari')){
				$params["data"] = $this->PaketModel->get_current_page_records_filter($limit_per_page, $start_index, $hari, $harga);	
			}
			else{
				$params["data"] = $this->PaketModel->get_current_page_records($limit_per_page, $start_index);
			}
			

			$config['base_url'] = base_url().'Paket/index';
			$config['total_rows'] = $total_records;
			$config['per_page'] = $limit_per_page;
			$config["uri_segment"] = 3;

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
      
			// build paging links
			$this->pagination->initialize($config);
			$params["links"] = $this->pagination->create_links();
        }
        $this->load->view('paket/paket', $params);
	}
	
}