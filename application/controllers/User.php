<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model('UserModel'); 
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');	
		$this->email->set_newline("\r\n");
	}
  
	public function index(){
  		if($this->session->userdata('status') != "login"){
			$this->load->view('user/login');
		}
		else{
			redirect(base_url(''));
		}
			
 	}
 
	public function login(){
    	$email=$this->input->post('email');
    	$pass=$this->input->post('password');
		$where = array(
			'email' => $email,
			'password' => $pass
		);
		$hasil=$this->UserModel->login($where);
		foreach ($hasil->result() as $data){
			$id_user= $data->id_user;
			$nama= $data->nama_user;
			$no_id= $data->no_indentittas;
			$tlpn= $data->tlpn_user;
			$negara= $data->negara_user;
			$alamat= $data->alamat;
			$email= $data->email;
		}
	
		$cek=$hasil->num_rows();
		if($cek==1){
			$data_session = array(
				'id_user' => $id_user,
				'user' => $nama,
				'no_id' => $no_id,
				'tlpn' => $tlpn,
				'negara' => $negara,
				'alamat' => $alamat,
				'email' => $email,
				'status_user' => "login"
			);
 			$user_data=$this->session->set_userdata($data_session);
			redirect(base_url(''));
		}
		else{
			echo "<script>alert('Login Failed'); window.history.back();</script>";	
		}
  }
 
	public function logout(){
		$this->session->set_userdata('status_user',"");
		redirect(base_url(''));
	}

	public function daftar(){
		$data = array(
			"email" => $this->input->post('emailDaf'),
			"password" => $this->input->post('passDaf'),
			"nama_user" => $this->input->post('namaDaf'),
			"no_indentitas" => $this->input->post('idDaf'),
			"tlpn_user" => $this->input->post('tlpnDaf'),
			"alamat_user" => $this->input->post('alamatDaf')
		);
		$this->UserModel->daftar($data); 
		echo "success";
 	}
	
	public function profil($id){
		$hasil['data'] = $this->UserModel->view_booking($id);				
		$this->load->view('user/profil', $hasil);
	}
	
}