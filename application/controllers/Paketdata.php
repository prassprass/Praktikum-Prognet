<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paketdata extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model('PaketdataModel'); 
        $this->load->model('HotelModel'); 
        $this->load->model('WisataModel'); 
        $this->load->helper(array('form', 'url'));
        $this->load->library('email');
        $this->email->set_newline("\r\n");
	}
  
	public function index(){
  		if($this->session->userdata('status_admin') != "login"){
			redirect(base_url("Admin"));
		}
		
		$hasil['data'] = $this->PaketdataModel->view_paket();								
		$hasil['data_wisata'] = $this->WisataModel->view_wisata();					
		$this->load->view('admin/data/data_paket', $hasil);
	}
    
  	public function load_data(){
   		$hasil['data'] = $this->PaketdataModel->view_paket();			
		echo json_encode($hasil); 
	}
  
    public function tambah_jenis_wisata(){
  		$data = array(
			"jenis_wisata" => $this->input->post('namajeniswisata'),
		);
		$this->WisataModel->savejenis($data); 
		echo "success";				
	}
  
  
	public function tambah_paket(){
  		$config['upload_path']          = './images/package';
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
				"nama_paket" => $this->input->post('nama'),
				"banyak_hari" => $this->input->post('hari'),
				"banyak_malam" => $this->input->post('malam'),
				  //"harga_paket" => $this->input->post('harga'),
				  "deskripsi_paket" => $this->input->post('deskripsi'),
				  "foto_paket" => $this->input->post('foto'),
				  "foto_paket" => $image
				);
				
				$this->PaketdataModel->save($data); 
				echo "success";

			}
	}
	
	public function edit($id){
    	$hasil_select['data_edit'] = $this->PaketdataModel->view_paket_byID($id);	
    	echo json_encode($hasil_select);
  	}
  
	public function update_without_image(){
		$id = $this->input->post('idED');
		$data = array(
			"nama_paket" => $this->input->post('namaED'),
			"banyak_hari" => $this->input->post('hariED'),
			"banyak_malam" => $this->input->post('malamED'),
			"deskripsi_paket" => $this->input->post('deskripsiED')
		);
			
		$this->PaketdataModel->update($id,$data);
		echo "success";		
	}
  
	public function update_with_image(){
  		echo $this->input->post('fotoED');
		$config['upload_path']          = './images/package/';
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
				"nama_paket" => $this->input->post('namaED'),
				"banyak_hari" => $this->input->post('hariED'),
				"banyak_malam" => $this->input->post('malamED'),
				"harga_paket" => $this->input->post('hargaED'),
				"deskripsi_paket" => $this->input->post('deskripsiED'),
				"foto_paket" => $this->input->post('fotoED'),
				"foto_paket" => $image
			);
				$this->PaketdataModel->update($id,$data);
				echo "success";	
			}		
	}
 
	public function delete(){
 		$id = $this->input->post('id');
		$data = array(
			"status_aktif_paket" => 0
		);
		$this->PaketdataModel->delete($id,$data); 
		echo "success";
	}
 

 	// HOTEL PAKET 
 	public function load_data_hotel($id){
  		$hasil['data_hotel'] = $this->PaketdataModel->view_paket_hotel($id);		
		echo json_encode($hasil); 
	}
 
 	public function delete_hotel(){
		$id = $this->input->post('id');
		$this->PaketdataModel->delete_hotel($id); 
		echo "success";
	}
  
	public function load_all_hotel($id){
		$hasil['data_hotel'] = $this->PaketdataModel->view_hotel_aviable($id);		
		echo json_encode($hasil); 
	}
  
	public function tambah_data_hotel(){
 		$id_paket = $this->input->post('id_paket');
 		$id_hotel = $this->input->post('id_hotel');
 		$lama = $this->input->post('lama_menginap');
		$data = array(
			"id_paket" => $id_paket,
			"id_hotel" => $id_hotel,
			"banyak_malam_hotel" => $lama
			);	
		$this->PaketdataModel->add_hotel($data); 		
		echo "success"; 
	}

	// WISATA PAKET 
 	public function load_data_wisata($id){
		$hasil['data_wisata'] = $this->PaketdataModel->view_paket_wisata($id);		
		echo json_encode($hasil); 
	}
 
	public function delete_wisata(){
		$id = $this->input->post('id');
		$this->PaketdataModel->delete_wisata($id); 
		echo "success";
	}
  
	public function load_all_wisata($id){
 		$hasil['data_wisata'] = $this->PaketdataModel->view_wisata_aviable($id);		
		echo json_encode($hasil); 
	}

	public function tambah_data_wisata(){
		$id_paket = $this->input->post('id_paket');
 		$id_wisata = $this->input->post('id_wisata');
 		$data = array(
			"id_paket" => $id_paket,
			"id_wisata" => $id_wisata
		);	
		
		$this->PaketdataModel->add_wisata($data); 		
		echo "success"; 
	}
  
	//UPDATE HARGA PAKET
	public function update_harga_paket(){
		$id_paket = $this->input->post('id_paket');
 		$harga_paket = $this->input->post('harga_paket');
		$data = array(
			"harga_paket" => $harga_paket
		);	
		$this->PaketdataModel->update_harga_paket($id_paket,$data); 		
		echo "success"; 
	}
  
}