<?php
$title['title'] = 'Data Paket';
$this->load->view('header-admin',$title);
?>

<script>

var id_paket_hotel;
var id_paket_wisata;

$(document).ready(function(){
 $('#wait').hide();
 $('#loading-wrap').hide();
	 
  });

  function reload(){

  $.ajax({
     type: "GET", 
     url: "<?php echo base_url(); ?>"+"Paketdata/load_data",
	 dataType : "json", 
     success: function(data) {
     var i = 0;
		$("#DataPaket").empty()
		while (i < data.data.length) {
		
			if(data.data[i].total_harga_paket == null){
				total_harga_paket_reload="Wisata Tujuan / Hotel Menginap Belum Ditentukan";
			}else{
				total_harga_paket_reload=data.data[i].total_harga_paket.slice(0,-5);
			}
		 	$("#DataPaket").append('<tr>'
										+'<td>'+(i+1)+'</td>'
										+'<td>'+data.data[i].nama_paket+'</td>'
										+'<td>'+data.data[i].banyak_hari+'</td>'
										+'<td>'+data.data[i].banyak_malam+'	</td>'
										+'<td>'+total_harga_paket_reload+'</td>'
										+'<td>'+data.data[i].deskripsi_paket+'</td>'
										+'<td><img src="<?=base_url()?>images/package/'+data.data[i].foto_paket+'" width="230px" height="200px">'
										+'<td><button type="button" onclick="edit_data('+data.data[i].id_paket+')" name="edit" class="btn btn-primary">'+'<i class="fa fa-edit" title="Edit"></i></button>'
										+'<button type="button" onclick="hapus_data('+data.data[i].id_paket+')" name="hapus" class="btn btn-danger">'+'<i class="fa fa-trash" title="hapus"></i></button><br>'
										+'<button type="button" onclick="wisata('+data.data[i].id_paket+')" name="wisata" class="btn btn-success"><i class="fa fa-map" title="wisata" ></i></button>'
										+'<button type="button" onclick="hotel('+data.data[i].id_paket+')" name="hotel" class="btn btn-info"><i class="fa fa-h-square" title="hotel" ></i></button></td>tr>'
										
								  );
				var harga = total_harga_paket_reload
				var id = data.data[i].id_paket
				update_harga_paket(id,harga);				
				i+=1;
             }
			$('#wait').hide();
			$('#loading-wrap').hide(); 
			$("#myModalSuccess").hide();
          }

       });

 }
 
		

	
    function tambah_data(){
			
		if(document.forms["formTambah"].nama.value==="")alert('Isikan Kolom Nama')
		else if(document.forms["formTambah"].hari.value==="")alert('Isikan Kolom Lama Hari Dengan Angka')	
		else if(document.forms["formTambah"].malam.value==="")alert('Isikan Kolom Lama Malam Dengan Angka')	
		//else if(document.forms["formTambah"].harga.value==="")alert('Isikan Kolom Harga Dengan Angka')
		else if(document.forms["formTambah"].deskripsi.value==="")alert('Isikan Kolom Deskripsi')
		else if(document.forms["formTambah"].foto.value==="")alert('Masukan Foto Wisata')
		else{
		
		  $('#wait').show();
		  $('#loading-wrap').show();
		  
		     var form = new FormData(document.getElementById("formTambah"));
			  form.append('foto',$('#foto')[0].files[0]);
			  form.append('nama ',$('#nama').val());
			  form.append('hari ',$('#hari').val());
			  form.append('harga ',$('#harga').val());
			  form.append('deskrisi ',$('#deskripsi').val());

		  
		   $.ajax({

		   
			type: "POST", 
			url: "<?php echo base_url(); ?>"+"Paketdata/tambah_paket",
			mimeType: "multipart/form-data",
			datatype : "json", 
			data: form,
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false, 			// To send DOMDocument or non processed data file it is set to false
			success: function(data) {
				if(data=="success"){
					  $("#myModalSuccess").modal();
					  $('#wait').hide();
					  $('#loading-wrap').hide();
						document.forms["formTambah"].nama.value="";
						document.forms["formTambah"].hari.value="";
						//document.forms["formTambah"].harga.value="";
						document.forms["formTambah"].deskripsi.value="";
						document.forms["formTambah"].foto.value="";
						
				}else{
					  $("#myModalFail").modal();
					  $('#wait').hide();
					  $('#loading-wrap').hide();
				}
			   }
			 }); 
		   }
	}

	$('#tambahjenis').click(function(){
		$("#ModalEdit").hide();
	});
	

   function edit_data(id_edit){
   
	$("#jenisED").empty()
        $.ajax({
        type: "GET", 
        url: "<?php echo base_url(); ?>"+"Paketdata/edit/"+id_edit,
        dataType : "json",
        success: function(data) {
			 document.getElementById("formedit").idED.value=data.data_edit[0].id_paket;
			 document.getElementById("formedit").namaED.value=data.data_edit[0].nama_paket;
			 document.getElementById("formedit").hariED.value=data.data_edit[0].banyak_hari;
			 document.getElementById("formedit").malamED.value=data.data_edit[0].banyak_malam;
			 //document.getElementById("formedit").hargaED.value=data.data_edit[0].harga_paket;
			 document.getElementById("formedit").deskripsiED.value=data.data_edit[0].deskripsi_paket;
			 document.getElementById("formedit").file_lama.value=data.data_edit[0].foto_paket;
			 $("#image_lama").attr("src","<?=base_url()?>/images/package/"+data.data_edit[0].foto_paket+"");
			 
			$("#ModalEdit").modal();		
          }
       });

	}	

	
    function update_data(){
			
		if(document.forms["formedit"].namaED.value==="")alert('Isikan Kolom Nama')
		else if(document.forms["formedit"].hariED.value==="")alert('Isikan Kolom Lama Hari Dengan Angka')	
		else if(document.forms["formedit"].malamED.value==="")alert('Isikan Kolom Lama Malam Dengan Angka')	
		//else if(document.forms["formedit"].hargaED.value==="")alert('Isikan Kolom Harga Dengan Angka')
		else if(document.forms["formedit"].deskripsiED.value==="")alert('Isikan Kolom Deskripsi')
		else{
	
	  $('#wait').show();
      $('#loading-wrap').show();
	  
		if(document.forms["formedit"].fotoED.value===""){
	  
		   $.ajax({
			type: "POST", 
			url: "<?php echo base_url(); ?>"+"Paketdata/update_without_image",
			datatype : "json", 
			data: $("#formedit").serialize(), 
			success: function(data) {
				if(data=="success"){
					  $("#myModalSuccess").modal();
					  $('#wait').hide();
					  $('#loading-wrap').hide();
					   
					   $("#ModalEdit").hide();
					   
				}else{
					  $("#myModalFail").modal();
					  $('#wait').hide();
					  $('#loading-wrap').hide();
				}
			   }
			 });
 
	   }else{

			var formED = new FormData(document.getElementById("formedit"));
			  formED.append('fotoED',$('#fotoED')[0].files[0]);
			  formED.append('idED ',$('#idED').val());
			  formED.append('namaED ',$('#namaED').val());
			  formED.append('hariED ',$('#hariED').val());
			  formED.append('malamED ',$('#malamED').val());
			  //formED.append('hargaED ',$('#hargaED').val());
			  formED.append('deskripsiED ',$('#deskripsiED').val());
			  formED.append('file_lama ',$('#file_lama').val());

		  
		   $.ajax({

		   
			type: "POST", 
			url: "<?php echo base_url(); ?>"+"Paketdata/update_with_image",
			mimeType: "multipart/form-data",
			datatype : "json", 
			data: formED,
			contentType: false,      
			cache: false,             
			processData:false, 			
			success: function(data) {
				if(data=="success"){
					  $("#myModalSuccess").modal();
					  $('#wait').hide();
					  $('#loading-wrap').hide();
					  
					  $("#ModalEdit").hide();
						
				}else{
					  $("#myModalFail").modal();
					  $('#wait').hide();
					  $('#loading-wrap').hide();
				}
			   }
			 }); 
		}
			
			
	   }
	}
	
		
   function hapus_data(id_del){
	  $('#wait').show();
      $('#loading-wrap').show();

       $.ajax({
        type: "POST", 
        url: "<?php echo base_url(); ?>"+"Paketdata/delete",
        datatype : "json", 
		data:{id:id_del},
        success: function(data) {
			if(data=="success"){
				  $("#myModalSuccess").modal();
				  $('#wait').hide();
				  $('#loading-wrap').hide();
			}else{
			   	 $("#myModalFail").modal();
				  $('#wait').hide();
				  $('#loading-wrap').hide();			
				}
		   }
		 }); 
	}	
	
	
	


//===========================================================  H O T E L ===============================================================//
	
	
  function hotel(id){

  id_paket_hotel=id;
	
  $.ajax({
     type: "GET", 
     url: "<?php echo base_url(); ?>"+"Paketdata/load_data_hotel/"+id,
	 dataType : "json", 
     success: function(data) {
		var i = 0;
		$("#DataHotel").empty();
		$("#HotelPaket").empty();	
		$("#total_harga_hotel").val(0);		
		if(data.data_hotel.length > 0){
			$("#HotelPaket").text(""+data.data_hotel[0].nama_paket);
			$("#StatusHotel").empty();			
				
			while (i < data.data_hotel.length) {
			
				$("#DataHotel").append('<tr>'
											+'<td>'+data.data_hotel[i].nama_hotel+'</td>'
											+'<td>'+data.data_hotel[i].biaya_permalam+'</td>'
											+'<td>'+data.data_hotel[i].banyak_malam_hotel+'</td>'
											+'<td>'+(data.data_hotel[i].banyak_malam_hotel)*(data.data_hotel[i].biaya_permalam)+'</td>'
											+'<td><button type="button" onclick="hapus_hotel('+data.data_hotel[i].id_det_hotel+')" name="edit" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban" title="Hapus"></i></button>'

									  );				  
					$("#total_harga_hotel").val(parseInt(($("#total_harga_hotel").val())) + parseInt((data.data_hotel[i].banyak_malam_hotel)*(data.data_hotel[i].biaya_permalam)));
					i+=1;

				 }
				 
		}else{
			$("#StatusHotel").text("Belum ada tempat menginap");
		}
				$('#wait').hide();
				$('#loading-wrap').hide(); 
				$("#load_hotel").empty();
				$("#load_hotel").append('<button type="button" onclick="load_hotel('+id+')" name="TambahHotel" class="btn btn-primary btn-lg" data-dismiss="modal">Tambah Hotel</button>');
				$("#ModalHotel").modal();
          }

       });

 }
 
 function load_hotel(id){

  $.ajax({
     type: "GET", 
     url: "<?php echo base_url(); ?>"+"Paketdata/load_all_hotel/"+id,
	 dataType : "json", 
     success: function(data) {
		$("#lama_menginap").val("");
		$("#formTambahHotel").append('<input type="hidden" value="'+id+'" name="id_paket">');
	
		 var i = 0;
			$("#id_hotel").empty();
				
				while (i < data.data_hotel.length) {
			 
					$("#id_hotel").append('<option value="'+data.data_hotel[i].id_hotel+'">'+data.data_hotel[i].nama_hotel+' || Rp.'+data.data_hotel[i].biaya_permalam+'/Malam</option>');
						
						i+=1;
					 }
		
					$('#wait').hide();
					$('#loading-wrap').hide();
					$("#ModalTambahHotel").modal();
			  }

       });

 }
 
 
 function hapus_hotel(id_del){

	  $('#wait').show();
      $('#loading-wrap').show();
	  
       $.ajax({
        type: "POST", 
        url: "<?php echo base_url(); ?>"+"Paketdata/delete_hotel",
        datatype : "json", 
		data:{id:id_del},
        success: function(data) {
			if(data=="success"){
				  $("#myModalSuccess").modal();
				  $('#wait').hide();
				  $('#loading-wrap').hide();
				  hotel(id_paket_hotel);
				  $('#ModalHotel').modal()
				  
			}else{
			   	 $("#myModalFail").modal();
				 $("#ModalHotel").modal();
				  $('#wait').hide();
				  $('#loading-wrap').hide();			
				}
		   }
		 }); 
	}
	
  function tambah_data_hotel(){
		   $.ajax({

		   
			type: "POST", 
			url: "<?php echo base_url(); ?>"+"Paketdata/tambah_data_hotel",
			data: $("#formTambahHotel").serialize(), 
			datatype : "json", 
			success: function(data) {
				if(data=="success"){
					  $("#myModalSuccess").modal();
					  $('#wait').hide();
					  $('#loading-wrap').hide();
					  hotel(id_paket_hotel);
					  $('#ModalHotel').modal()
						
				}else{
					  $("#myModalFail").modal();
					  $('#wait').hide();
					  $('#loading-wrap').hide();
				}
			   }
			 }); 
}



//===========================================================  W I S A T A ===============================================================//


function wisata(id){
  
  id_paket_wisata=id;
  
  $.ajax({
     type: "GET", 
     url: "<?php echo base_url(); ?>"+"Paketdata/load_data_wisata/"+id,
	 dataType : "json", 
     success: function(data) {
		var i = 0;
		$("#total_harga_wisata").val(0);		
		$("#DataWisata").empty();
		$("#WisataPaket").empty();	
		
		if(data.data_wisata.length > 0){
			$("#WisataPaket").text(""+data.data_wisata[0].nama_paket);
			$("#StatusWisata").empty();			
				
			while (i < data.data_wisata.length) {
		 
				$("#DataWisata").append('<tr>'
											+'<td>'+data.data_wisata[i].nama_tempat_wisata+'</td>'
											+'<td>'+data.data_wisata[i].harga_tiket+'</td>'
											+'<td><button type="button" onclick="hapus_wisata('+data.data_wisata[i].id_det_wisata+')" name="edit" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban" title="Hapus"></i></button>'

									  );
									  
					$("#total_harga_wisata").val(parseInt(($("#total_harga_wisata").val())) + parseInt(data.data_wisata[i].harga_tiket));
					i+=1;
				 }
		}else{
			$("#StatusWisata").text("Belum ada tujuan wisata");
		}
				$('#wait').hide();
				$('#loading-wrap').hide(); 
				$("#load_wisata").empty();
				$("#load_wisata").append('<button type="button" onclick="load_wisata('+id+')" name="TambahWisata" class="btn btn-primary btn-lg" data-dismiss="modal">Tambah Wisata</button>');
				$("#ModalWisata").modal();
          }

       });

 }
 
 function load_wisata(id){

  $.ajax({
     type: "GET", 
     url: "<?php echo base_url(); ?>"+"Paketdata/load_all_wisata/"+id,
	 dataType : "json", 
     success: function(data) {
	 
	$("#formTambahWisata").append('<input type="hidden" value="'+id+'" name="id_paket">');
	
     var i = 0;
		$("#id_wisata").empty();
			
			while (i < data.data_wisata.length) {
		 
				$("#id_wisata").append('<option value="'+data.data_wisata[i].id_wisata+'">'+data.data_wisata[i].nama_tempat_wisata+' || Rp.'+data.data_wisata[i].harga_tiket+'</option>');
					
					i+=1;
				 }
	
				$('#wait').hide();
				$('#loading-wrap').hide();
				$("#ModalTambahWisata").modal();
          }

       });

 }
 
 
 function hapus_wisata(id_del){
	
	  $('#wait').show();
      $('#loading-wrap').show();
	  
       $.ajax({
        type: "POST", 
        url: "<?php echo base_url(); ?>"+"Paketdata/delete_wisata",
        datatype : "json", 
		data:{id:id_del},
        success: function(data) {
			if(data=="success"){
				  $("#myModalSuccess").modal();
				  $('#wait').hide();
				  $('#loading-wrap').hide();
				  wisata(id_paket_wisata);
				  $('#ModalWisata').modal()
				  
			}else{
			   	 $("#myModalFail").modal();
				 $("#ModalWisata").modal();
				  $('#wait').hide();
				  $('#loading-wrap').hide();			
				}
		   }
		 }); 
	}
	
  function tambah_data_wisata(){
	   $.ajax({

	   
		type: "POST", 
		url: "<?php echo base_url(); ?>"+"Paketdata/tambah_data_wisata",
		data: $("#formTambahWisata").serialize(), 
		datatype : "json", 
		success: function(data) {
			if(data=="success"){
				  $("#myModalSuccess").modal();
				  $('#wait').hide();
				  $('#loading-wrap').hide();
				  wisata(id_paket_wisata);
				  $('#ModalWisata').modal()				  
					
			}else{
				  $("#myModalFail").modal();
				  $('#wait').hide();
				  $('#loading-wrap').hide();
			}
		   }
		 }); 
	}

//================================================================== UPDATE HARGA PKAET ===========================================================================//
	
  function update_harga_paket(id,harga){
	   $.ajax({
   
		type: "POST", 
		url: "<?php echo base_url(); ?>"+"Paketdata/update_harga_paket",
		data: '&id_paket=' + id + '&harga_paket=' + harga, 
		datatype : "json", 

		 }); 
	}	
 
	
</script>



<div class="page-wrapper">
        <div class="page-header">
            <h3>Data Wisata <small>Data Wisata</small></h3>
		</div>

        <ul class="breadcrumb">
            <li><a href='<?php echo base_url("Paketdata"); ?>'>View Data</a></li>
            <li><a href=''>Tambah konten</a></li>
            <li><a href=''>Edit konten</a></li>

        </ul>
 
    <div style="color: red;"><?php echo validation_errors(); ?></div>

	
	 <section class="content">
    <div class="box">
        <div class="box-header">
            <h3>Data Wisata <small>Overview</small></h3>
        </div>
		

        <div class="box-body">
            <div class="table-responsive">
            <table id="table_content" class="table table-bordered">
            	<thead>
                	<tr>
                    	<th>No</th>
                    	<th>Nama Paket</th>
                    	<th width="3%">Banyak Hari</th >
                    	<th width="3%">Banyak Malam</th>
                    	<th>Harga Paket</th>
                    	<th>Deskripsi Paket</th>
                    	<th>Foto Paket</th>
                    	<th width="10%">Aksi</th>

                    </tr>
                </thead>
                <tbody id="DataPaket">
                <?php 
            	$no =1;
                  if( !empty($data)){ 
            		foreach($data as $data){
					
						 echo 	"<script type='text/javascript'>
									var harga = ".substr($data->total_harga_paket,0,-5)."
									var id = ".$data->id_paket."
									update_harga_paket(id,harga);
								</script>";
            	?>	
            	    	<tr>
                    	<td><?=$no?></td>	
                    	<td><?=$data->nama_paket?></td>
                    	<td><?=$data->banyak_hari?></td>
                    	<td><?=$data->banyak_malam?></td>
                    	<td><?=($data->total_harga_paket)?substr($data->total_harga_paket,0,-5):"Wisata Tujuan / Hotel Menginap Belum Ditentukan"?></td>
                    	<td><?=$data->deskripsi_paket?></td>
                    	<td><img src="<?=base_url()?>images/package/<?=$data->foto_paket?>" width="230px" height="200px"></td>
            			<td>
            				<button type="button" onclick="edit_data(<?=$data->id_paket?>)" name="edit" class="btn btn-primary"><i class="fa fa-edit" title="Edit"></i></button>
            				<button type="button" onclick="hapus_data(<?=$data->id_paket?>)" name="hapus" class="btn btn-danger"><i class="fa fa-trash" title="hapus" ></i></button>
							<br>
            				<button type="button" onclick="wisata(<?=$data->id_paket?>)" name="wisata" class="btn btn-success"><i class="fa fa-map" title="wisata" ></i></button>
            				<button type="button" onclick="hotel(<?=$data->id_paket?>)" name="hotel" class="btn btn-info"><i class="fa fa-h-square " title="hotel" ></i></button>
							</td>

            		</tr>
            		<?php
            		$no++;
            				
            		}
            	}
            	?>
                </tbody>
            </table>
            </div>
        </div>
		
		`<button type="button" data-toggle="modal" data-target="#ModalTambah" name="tambah" class="btn btn-primary btn-lg"/>Tambah Data</button>
	
    </div>
    </section>
	
	

	
	
<!-- Form  Tambah !-->

<div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="overflow:auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                   Form Tambah Paket
                </h4>
            </div>
            <div class="modal-body">
                
				        <form id="formTambah" action="" method="POST" enctype="multipart/form-data"> 
				
						<div class="form-group">
							<input type="text" name="nama" class="form-control fc-form" placeholder="Nama Paket" id="nama"/>
						</div>	
						
						<div class="form-group">
							<input type="number" name="hari" class="form-control fc-form" placeholder="Lama Hari" id="hari"/>
						</div>						
						
						<div class="form-group">
							<input type="number" name="malam" class="form-control fc-form" placeholder="Lama Malam" id="malam"/>
						</div>
						<!--
						<div class="form-group">
							<input type="number" name="harga" class="form-control fc-form" placeholder="Harga Paket per Pack" id="harga"/>
						</div>
						!-->
						<div class="form-group">
							<textarea name="deskripsi" rows="6" class="form-control fc-form" placeholder="Tentang Paket" id="deskripsi"></textarea>
						</div>	
						
					<!--
						<!-- combo box hotel 					
							<div class="row">
								<div class="form-group">
									<div id="hotel_select">
										<div class="col-sm-10">
											<select name="jenis" rows="6" class="form-control" id="jenis">
											<?php 
												if( !empty($data_hotel)){ 
												foreach($data_hotel as $data_hotel){
											?>
												<option value="<?=$data_hotel->id_hotel?>">
													<div id="jenisP"><?=$data_hotel->nama_hotel?></div>
												</option>
												<?php	
														} 
													} 
												?>
												</select>		
										</div>
										<div class="col-sm-2">
											<button type="button" name="tambahjenis"  class="btn btn-danger"/>-</button>
										</div>
									</div>	
									
									<div class="col-sm-6">
										<button type="button" name="tambahjenis" onclick="plus_hotel()" class="btn btn-primary" style="width:100%;" />+</button>						
									</div>
										
								</div>
							</div>
								
						<!--combo box wisata
						<div class="row">
							<div class="form-group">

									<div class="col-sm-10">
											<select name="jenis" rows="6" class="form-control" id="jenis">
											<?php 
												if( !empty($data_wisata)){ 
												foreach($data_wisata as $data_wisata){
											?>
												<option value="<?=$data_wisata->id_wisata?>">
													<div id="jenisP"><?=$data_wisata->nama_tempat_wisata?></div>
												</option>
											<?php	
													} 
												} 
											?>
											</select>	
									</div>
									<div class="col-sm-2">
										<button type="button" name="tambahjenis" class="btn btn-danger"/>-</button>
									</div>

									<div class="col-sm-6">
										<button type="button" name="tambahjenis" class="btn btn-primary" style="width:100%" />+</button>						
									</div>
								
							</div>
						</div>
					!-->	
						
						<div class="form-group">
							<input type="file" name="foto" class="form-control-file fc-form" id="foto"/>
						</div>
              
            </div>
			<div class="modal-footer">
				<div class="form-group">
					<button onclick="tambah_data()" id="simpan" type="button" name="simpan" class="btn btn-success" data-dismiss="modal"/>SIMPAN</button>
					<input type="reset" name="reset" class="btn btn-danger" value="ULANG" />
				</div>
			</div>	
				
					</form>
        </div>
    </div>
</div>



<!-- MODAL VIEW HOTEL !-->

<div class="modal fade" id="ModalHotel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel" align="center">
                   Data Tempat Menginap Paket <b id="HotelPaket"></b>
                </h4>
            </div>
            <div class="modal-body">
			
			<h4 id="StatusHotel" style="opacity:0.4"></h4>
			
            <table id="table_content" class="table table-bordered">
				<tr>
					<th>Nama Hotel</th>
					<th>Harga PerMalam</th>
					<th>Lama Menginap</th>
					<th>Total harga</th>
					<th>Hapus Hotel</th>
				</tr>
                <tbody id="DataHotel">
				
                </tbody>
            </table>
				<label>Total Biaya Hotel </label>
				<input type="text" name="total_harga_hotel" id="total_harga_hotel" class="form-control fc-form" readonly>
						              
            </div>
			<div class="modal-footer">
				<div class="form-group" id="load_hotel">
					
				</div>
			</div>			
        </div>
    </div>
</div>


<!-- Form Tambah Hotel !-->

<div class="modal fade" id="ModalTambahHotel" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                   Form Tambah Data Hotel Menginap
                </h4>
            </div>
            <div class="modal-body">
                
				        <form id="formTambahHotel" action="" method="POST"> 
				
						<div class="form-group">
							<select name="id_hotel" rows="6" class="form-control" id="id_hotel">
							
							</select>		
						</div>
						<div class="form-group">
							<input type="number" name="lama_menginap" id="lama_menginap" placeholder="Lama Menginap dihotel" class="form-control fc-form" >
						</div>
						              
            </div>
			<div class="modal-footer">
				<div class="form-group">
					<button onclick="tambah_data_hotel()" type="button" name="submit" class="btn btn-success" data-dismiss="modal"/>SIMPAN</button>
				</div>
			</div>	
				
					</form>
        </div>
    </div>
</div>







<!-- MODAL VIEW WISATA !-->

<div class="modal fade" id="ModalWisata" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel" align="center">
                   Data Tujuan Wisata <b id="WisataPaket"></b>
                </h4>
            </div>
            <div class="modal-body">
			
			<h4 id="StatusWisata" style="opacity:0.4"></h4>
			
            <table class="table table-bordered">
                <tr>
					<th>Nama Wisata</th>
					<th>Harga Tiket Masuk</th>
					<th>Hapus Wisata</th>
				</tr>
				<tbody id="DataWisata">
				
                </tbody>
            </table>
			<label>Total Biaya Wisata </label>
			<input type="text" name="total_harga_wisata" id="total_harga_wisata" class="form-control fc-form" readonly>	
						              
            </div>
			<div class="modal-footer">
				<div class="form-group" id="load_wisata">
					
				</div>
			</div>			
        </div>
    </div>
</div>


<!-- Form Tambah Wisata !-->

<div class="modal fade" id="ModalTambahWisata" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                   Form Tambah Data Wisata Tujuan
                </h4>
            </div>
            <div class="modal-body">
                
				        <form id="formTambahWisata" action="" method="POST"> 
				
						<div class="form-group">
							<select name="id_wisata" rows="6" class="form-control" id="id_wisata">
							
							</select>		
						</div>
						              
            </div>
			<div class="modal-footer">
				<div class="form-group">
					<button onclick="tambah_data_wisata()" type="button" name="submit" class="btn btn-success" data-dismiss="modal"/>SIMPAN</button>
				</div>
			</div>	
				
					</form>
        </div>
    </div>
</div>









<!-- Form  edit !-->

<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                   Form Edit Data Paket
                </h4>
            </div>
            <div class="modal-body">
                
				        <form id="formedit" action="" method="POST" enctype="multipart/form-data"> 
						
							<input type="hidden" name="idED" id="idED" />
				
						<div class="form-group">
							<label style="color:#3e3c3c">Nama Paket</label>
							<input type="text" name="namaED" class="form-control fc-form" placeholder="Nama Paket" id="namaED"/>
						</div>	
						
						<div class="form-group">
							<label style="color:#3e3c3c">Lama Hari</label>	
							<input type="number" name="hariED" class="form-control fc-form" placeholder="Lama Hari" id="hariED"/>
						</div>						
						
						<div class="form-group">
							<label style="color:#3e3c3c">Lama Malam</label>
							<input type="number" name="malamED" class="form-control fc-form" placeholder="Lama Malam" id="malamED"/>
						</div>
						<!--
						<div class="form-group">
							<label style="color:#3e3c3c">Harga Paket</label>
							<input type="number" name="hargaED" class="form-control fc-form" placeholder="Harga Paket per Pack" id="hargaED"/>
						</div>
						!-->
						<div class="form-group">
							<label style="color:#3e3c3c">Deskripsi Paket</label>
							<textarea name="deskripsiED" rows="6" class="form-control fc-form" placeholder="Tentang Paket" id="deskripsiED"></textarea>
						</div>	
							<label style="color:#3e3c3c">Foto Paket</label>						
							<img src="" id="image_lama" width="100">
							<input name="file_lama" type="text" id="file_lama" hidden> 
							<input type="file" name="fotoED" class="form-control-file fc-form" id="fotoED"/>
						
			</div>

              
            </div>
			<div class="modal-footer">
				<div class="form-group">
					<button onclick="update_data()" type="button" name="update" class="btn btn-success" data-dismiss="modal">SIMPAN</button>
					<input type="reset" name="reset" class="btn btn-danger" value="ULANG" />
				</div>
			</div>	
				
					</form>
        </div>
    </div>
</div>


<?php $this->load->view('admin/modal');?>

<script>
function plus_hotel(){
		
	$("#hotel_select").append('<div class="col-sm-10">'
 			+'<select name="jenis" rows="6" class="form-control" id="jenis">'
 				+'<option value="1">'
 					+'<div id="jenisP">aa</div>'
 				+'</option>'
 			+'</select>'	
 		+'</div>'
 		+'<div class="col-sm-2">'
 			+'<button type="button" name="tambahjenis" class="btn btn-danger"/>-</button>'
 		+'</div>');
}
</script>	
	
</div>
</div>
</body>
</html>
