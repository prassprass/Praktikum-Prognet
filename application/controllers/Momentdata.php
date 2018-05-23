<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Momentdata extends CI_Controller {
	public function __construct(){
		parent::__construct();
  		$this->load->model('momentModel'); 
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');	
		$this->email->set_newline("\r\n");
  	}
  
	public function index(){
  		if($this->session->userdata('status_admin') != "login"){
			redirect(base_url("Admin"));
		}
		$hasil['data'] = $this->momentModel->view_wisata();				
		$this->load->view('admin/data/data_moment', $hasil);
  	}
   
  	public function load_data(){
  		$hasil['data'] = $this->momentModel->view_wisata();		
		echo json_encode($hasil); 
	}

	public function tambah_wisata(){
		$config['upload_path']          = './images/moment';
		$config['allowed_types']        = 'gif|jpg|png';
		$this->load->library('upload', $config);
 
		if ( ! $this->upload->do_upload('foto_moment')){
			$error = $this->upload->display_errors();
			echo $error;
		}
		else{
			
			//dapatkan data file yg d upload
			$upload_data = $this->upload->data();
 
			//dapatkan nama file
			$image = $upload_data['file_name'];
 
			$data = array(
				"judul_moment" => $this->input->post('nama'),
				"lokasi_moment" => $this->input->post('lokasi'),
				"tanggal_moment" => $this->input->post('tanggal'),
				"deskripsi_moment" => $this->input->post('deskripsi'),
				"foto_moment" => $this->input->post('foto_moment'),
				"foto_moment" => $image
			);	
			$this->momentModel->save($data); 
			echo "success";
		}
	}
	
	public function edit($id){
    	$hasil_select['data_edit'] = $this->momentModel->view_id_moment($id);
    	echo json_encode($hasil_select);
	}
  
	public function update_without_image(){
		$id = $this->input->post('idED');
		$data = array(
			"judul_moment" => $this->input->post('namaED'),
			"lokasi_moment" => $this->input->post('lokasiED'),
			"tanggal_moment" => $this->input->post('tanggalED'),
			"deskripsi_moment" => $this->input->post('deskripsiED')
		);
		$this->momentModel->update($id,$data); // Panggil fungsi edit() yang ada di SiswaModel.php
		echo "success";
  	}
  
	public function update_with_image(){
  		echo $this->input->post('fotomomentED');
		$config['upload_path']          = './images/moment';
		$config['allowed_types']        = 'gif|jpg|png';					 
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('fotomomentED')){
			$error = $this->upload->display_errors();
			echo $error;		
		}
		else{
			$file_lama=$this->input->post('file_lama'); 
			
			//menghapus gambar lama, variabel dibawa dari form
				$upload_data = $this->upload->data();
	 			$image = $upload_data['file_name'];
	 			$id = $this->input->post('idED');
				$data = array(
            		"judul_moment" => $this->input->post('namaED'),
            		"lokasi_moment" => $this->input->post('lokasiED'),
            		"tanggal_moment" => $this->input->post('tanggalED'),
            		"deskripsi_moment" => $this->input->post('deskripsiED'),
            		"foto_moment" => $this->input->post('fotomomentED'),
            		"foto_moment" => $image
				);
				$this->momentModel->update($id,$data);
				echo "success";	
		}	
	 }
	 
}