<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct(){
	    parent::__construct();
	    $this->load->model('AdminModel'); 
		$this->load->helper(array('form', 'url'));
	}
	  
	public function index(){
		if($this->session->userdata('status_admin') != "login"){
			$this->load->view('Admin/index');
		}
		else{
			$hasil['data']=$this->AdminModel->view_content();
			$this->load->view('Admin/dashboard',$hasil);
		}
	}
	 
	public function login(){
		$user=$this->input->post('username');
	    $pass=$this->input->post('password');
		$where = array(
			'username' => $user,
			'password' => $pass
		);
		
		$hasil=$this->AdminModel->login($where);
		$cek=$hasil->num_rows();
		if($cek==1){
			$data_session = array(
				'admin' => $user,
				'status_admin' => "login"
			);
	 		$this->session->set_userdata($data_session);
			$data['data']=$this->AdminModel->view_content();
			$this->load->view('Admin/dashboard',$data);
		}
		else{
			echo "<script>alert('Login Failed'); window.history.back();</script>";	
		}
	}
	 
	public function logout(){
		$this->session->set_userdata('status_admin', "");
		redirect(base_url('Admin'));
	}
 
}