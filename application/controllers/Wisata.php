<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wisata extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model('WisataModel'); 
        $this->load->helper(array('form', 'url'));
        $this->load->library('email');	
        $this->email->set_newline("\r\n");
    }
  
	public function index(){
  		if($this->session->userdata('status_admin') != "login"){
			redirect(base_url("Admin"));
		}
		$hasil['data'] = $this->WisataModel->view_wisata();		
		$hasil['data_jenis'] = $this->WisataModel->jenis_wisata();		
		$this->load->view('admin/data/data_wisata', $hasil);
	}
  
	public function load_jenis(){
  		$hasil['data_jenis'] = $this->WisataModel->jenis_wisata(); 
		echo json_encode($hasil);
	}
  	
  	public function load_data(){
		$hasil['data'] = $this->WisataModel->view_wisata();		
		$hasil['data_jenis'] = $this->WisataModel->jenis_wisata();		
		echo json_encode($hasil); 
	}
	
	public function tambah_jenis_wisata(){
		$data = array(
			"jenis_wisata" => $this->input->post('namajeniswisata'),
		);
		$this->WisataModel->savejenis($data); 
		echo "success";				
	}
  
	public function tambah_wisata(){
		$config['upload_path']          = './images/top-destination';
		$config['allowed_types']        = 'gif|jpg|png';
		$this->load->library('upload', $config);
 		if ( ! $this->upload->do_upload('foto')){
			$error = $this->upload->display_errors();
			echo $error;
		}
		else{
		
			//dapatkan data file yg d upload
			$upload_data = $this->upload->data();
 
			//dapatkan nama file
			$image = $upload_data['file_name'];
			$data = array(
				"nama_tempat_wisata" => $this->input->post('nama'),
				"lokasi" => $this->input->post('lokasi'),
				"id_jenis_wisata" => $this->input->post('jenis'),
				"frame_peta" => $this->input->post('map'),
				"harga_tiket" => $this->input->post('harga'),
				"deskripsi_wisata" => $this->input->post('deskripsi'),
				"foto_wisata" => $this->input->post('foto'),
				"foto_wisata" => $image
			);				
			$this->WisataModel->save($data); 
			echo "success";
		}
	}
	
	public function edit($id){
		$hasil_select['data_edit'] = $this->WisataModel->view_id_wisata($id);
		$hasil_select['data_jenis'] = $this->WisataModel->jenis_wisata();	
		echo json_encode($hasil_select);
	}
  
	public function update_without_image(){
  		$id = $this->input->post('idED');
		$data = array(
			"nama_tempat_wisata" => $this->input->post('namaED'),
			"lokasi" => $this->input->post('lokasiED'),
			"id_jenis_wisata" => $this->input->post('jenisED'),
			"frame_peta" => $this->input->post('mapED'),
			"harga_tiket" => $this->input->post('hargaED'),
			"deskripsi_wisata" => $this->input->post('deskripsiED')
		);
		$this->WisataModel->update($id,$data); // Panggil fungsi edit() yang ada di SiswaModel.php
		echo "success";
	}
  
	public function update_with_image(){
		echo $this->input->post('fotoED');
		$config['upload_path']          = './images/top-destination/';
		$config['allowed_types']        = 'gif|jpg|png';
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('fotoED')){
			$error = $this->upload->display_errors();
			echo $error;		
		}
		else{		
			$file_lama=$this->input->post('file_lama'); 
			
			//menghapus gambar lama, variabel dibawa dari form
			unlink($config['upload_path'].$file_lama); 		
			$upload_data = $this->upload->data();
			$image = $upload_data['file_name'];
			$id = $this->input->post('idED');
			$data = array(
				"nama_tempat_wisata" => $this->input->post('namaED'),
				"lokasi" => $this->input->post('lokasiED'),
				"id_jenis_wisata" => $this->input->post('jenisED'),
				"frame_peta" => $this->input->post('mapED'),
				"harga_tiket" => $this->input->post('hargaED'),
				"deskripsi_wisata" => $this->input->post('deskripsiED'),
				"foto_wisata" => $this->input->post('fotoED'),
				"foto_wisata" => $image
			);
					
			$this->WisataModel->update($id,$data);
			echo "success";	
		}	
 	}
 
	public function delete(){
 		$id = $this->input->post('id');
 		$data = array(
			"status_aktif" => 0
		);
    	$this->WisataModel->delete($id,$data); 
		echo "success";
	}

}