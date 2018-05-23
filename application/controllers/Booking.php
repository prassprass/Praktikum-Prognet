<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends CI_Controller {
	public function __construct(){
		parent::__construct();
	    $this->load->model('BookingModel'); 
		$this->load->helper(array('form', 'url')); 
		$this->load->library('pagination');
	}

	public function index(){
		$total_records = $this->BookingModel->get_total();
		// init params
	    $params = array();
	    $limit_per_page = 6;
	    $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	    if ($total_records > 0) {
	        // get current page records
			$params["data"] 		= $this->BookingModel->get_current_page_records($limit_per_page, $start_index);
			$config['base_url'] 	= base_url().'Booking/index';
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
					 
			// build paging links
			$this->pagination->initialize($config);
			$params["links"] = $this->pagination->create_links();
        }
	         
		if($this->session->userdata('status_user') != "login"){
			$this->load->view('User/login');
		}
		else{
			$this->load->view('booking/booking', $params);
		} 
	}
		
	public function load_harga_paket($id){
		$hasil=$this->BookingModel->harga($id);
		echo json_encode($hasil); 
	}
	     
	public function booking(){
		$data = array(
			"id_user" 				=> $this->input->post('id_user'),
			"banyak_traveler" 		=> $this->input->post('pack'),
			"tgl_traveling" 		=> $this->input->post('tanggal'),
			"tgl_booking" 			=> date("Y-m-d"),
			"id_paket" 				=> $this->input->post('pk'),
			"biaya_traveling" 		=> $this->input->post('total_harga'),
			"permintaan_spesial" 	=> $this->input->post('msg'),
			"status_pembayaran" 	=> -1						  
		);
							
		$this->BookingModel->booking($data); 
		echo "success";	
	}
		
}
