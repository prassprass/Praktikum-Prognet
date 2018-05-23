<?php
$title['title'] = 'Data Wisata';
$this->load->view('header-admin',$title);
?>

<script>
$(document).ready(function(){
 $('#wait').hide();
 $('#loading-wrap').hide();
 
  });
  
  function reload(){

  $.ajax({
     type: "GET", 
     url: "<?php echo base_url(); ?>"+"Wisata/load_data",
	 dataType : "json", 
     success: function(data) {
     var i = 0;
		$("#dataWisata").empty()
		while (i < data.data.length) {
	 
		 	$("#dataWisata").append("<tr><td>"+(i+1)+"</td><td>"+data.data[i].nama_tempat_wisata+"</td><td>"+data.data[i].lokasi+"</td><td>"+data.data[i].jenis_wisata+"</td><td>"+data.data[i].harga_tiket+"</td><td>"+data.data[i].deskripsi_wisata+"</td><td><img src='<?=base_url()?>images/top-destination/"+data.data[i].foto_wisata+"' width='230px' height='200px'></td><td><button type='button' onclick='edit_data("+data.data[i].id_wisata+")' name='edit' class='btn btn-primary'><i class='fa fa-edit' title='Edit'></i></button></td></tr>");
				i+=1;
             }
			$('#wait').hide();
			$('#loading-wrap').hide(); 
			$("#myModalSuccess").hide();
          }

       });

 }
 
 function load_jenis(){
	  $.ajax({
        type: "GET", 
        url: "<?php echo base_url(); ?>"+"Wisata/load_jenis",
        dataType : "json",
        success: function(data) {
		
			//while (i < data.data_jenis.length) {

				$("#jenis").append("<option value='"+data.data_jenis[data.data_jenis.length-1].id_jenis_wisata+"'>"+ data.data_jenis[data.data_jenis.length-1].jenis_wisata +"</option>");  
				//i++;		 
			//}

		  }
       });
 
 }
  
    function tambah_data_jenis(){
			
	if(document.forms["formTambahJenis"].namajeniswisata.value==="")alert('Isikan Kolom Nama Jenis Wisata')
	else{
	
	  $('#wait').show();
      $('#loading-wrap').show();
	  
       $.ajax({
        type: "POST", 
        url: "<?php echo base_url(); ?>"+"Wisata/tambah_jenis_wisata",
        datatype : "json", 
        data: $("#formTambahJenis").serialize(), 
        success: function(data) {
			if(data=="success"){
				  $('#wait').hide();
				  $('#loading-wrap').hide();
				   
				   $("#ModalTambahJenis").hide();
				   document.forms["formTambahJenis"].namajeniswisata.value="";
				   load_jenis();
				   
			}else{
			   	  $("#myModalFail").modal();
				  $('#wait').hide();
				  $('#loading-wrap').hide();
			}
		   }
		 }); 
	   }
	}
	
    function tambah_data(){
			
		if(document.forms["formTambah"].nama.value==="")alert('Isikan Kolom Nama')
		else if(document.forms["formTambah"].lokasi.value==="")alert('Isikan Kolom Alamat')	
		else if(document.forms["formTambah"].jenis.value==="")alert('Isikan Kolom Telepon')
		else if(document.forms["formTambah"].map.value==="")alert('Isikan Kolom Biaya Per Malam Dengan Angka')
		else if(document.forms["formTambah"].harga.value==="")alert('Isikan Kolom HargaDengan Angka')
		else if(document.forms["formTambah"].deskripsi.value==="")alert('Isikan Kolom Deskripsi')
		else if(document.forms["formTambah"].foto.value==="")alert('Masukan Foto Wisata')
		else{
		
		  $('#wait').show();
		  $('#loading-wrap').show();
		  
		     var form = new FormData(document.getElementById("formTambah"));
			  form.append('foto',$('#foto')[0].files[0]);
			  form.append('nama ',$('#nama').val());
			  form.append('lokasi ',$('#lokasi').val());
			  form.append('jenis ',$('#jenis').val());
			  form.append('map ',$('#map').val());
			  form.append('harga ',$('#harga').val());
			  form.append('deskrisi ',$('#deskripsi').val());

		  
		   $.ajax({

		   
			type: "POST", 
			url: "<?php echo base_url(); ?>"+"Wisata/tambah_wisata",
			mimeType: "multipart/	form-data",
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
						document.forms["formTambah"].lokasi.value="";
						document.forms["formTambah"].jenis.value="";
						document.forms["formTambah"].map.value="";
						document.forms["formTambah"].harga.value="";
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
        url: "<?php echo base_url(); ?>"+"Wisata/edit/"+id_edit,
        dataType : "json",
        success: function(data) {
			 document.getElementById("formedit").idED.value=data.data_edit.id_wisata;
			 document.getElementById("formedit").namaED.value=data.data_edit.nama_tempat_wisata;
			 document.getElementById("formedit").lokasiED.value=data.data_edit.lokasi;
			 document.getElementById("formedit").mapED.value=data.data_edit.frame_peta;
			 document.getElementById("formedit").hargaED.value=data.data_edit.harga_tiket;
			 document.getElementById("formedit").deskripsiED.value=data.data_edit.deskripsi_wisata;
			 document.getElementById("formedit").file_lama.value=data.data_edit.foto_wisata;
			 $("#image_lama").attr("src","<?=base_url()?>/images/top-destination/"+data.data_edit.foto_wisata+"");
			

			
			var i=0;	
			while (i < data.data_jenis.length) {
				
				if(data.data_jenis[i].id_jenis_wisata==data.data_edit.id_jenis_wisata) var sl="selected"
				else var sl=""
			
				$("#jenisED").append("<option value='"+data.data_jenis[i].id_jenis_wisata+"' "+sl+">"+data.data_jenis[i].jenis_wisata+"</option>");  
				i++;
			 }
			 
				$("#ModalEdit").modal();		 
          }
       });

	}	

    function update_data(){
			
		if(document.forms["formedit"].namaED.value==="")alert('Isikan Kolom Nama')
		else if(document.forms["formedit"].lokasiED.value==="")alert('Isikan Kolom Alamat')	
		else if(document.forms["formedit"].jenisED.value==="")alert('Isikan Kolom Telepon')
		else if(document.forms["formedit"].mapED.value==="")alert('Isikan Kolom Biaya Per Malam Dengan Angka')
		else if(document.forms["formedit"].hargaED.value==="")alert('Isikan Kolom HargaDengan Angka')
		else if(document.forms["formedit"].deskripsiED.value==="")alert('Isikan Kolom Deskripsi')
		else{
	
	  $('#wait').show();
      $('#loading-wrap').show();
	  
		if(document.forms["formedit"].fotoED.value===""){
	  
		   $.ajax({
			type: "POST", 
			url: "<?php echo base_url(); ?>"+"Wisata/update_without_image",
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
			  formED.append('messageED ',$('#namaED').val());
			  formED.append('lokasiED ',$('#lokasiED').val());
			  formED.append('jenisED ',$('#jenisED').val());
			  formED.append('mapED ',$('#mapED').val());
			  formED.append('hargaED ',$('#hargaED').val());
			  formED.append('deskrisiED ',$('#deskripsiED').val());
			  formED.append('file_lama ',$('#file_lama').val());

		  
		   $.ajax({

		   
			type: "POST", 
			url: "<?php echo base_url(); ?>"+"Wisata/update_with_image",
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
	
		

</script>



<div class="page-wrapper">
        <div class="page-header">
            <h3>Data Wisata <small>Data Wisata</small></h3>
		</div>

        <ul class="breadcrumb">
            <li><a href='<?php echo base_url("Wisata"); ?>'>View Data</a></li>
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
                    	<th>Nama Wisata</th>
                    	<th>Lokasi Wisata</th>
                    	<th>Jenis Wisata</th>
                    	<th>Harga Tiket</th>
                    	<th>Deskripsi Wisata</th>
                    	<th>Foto Wisata</th>
                    	<th>Aksi</th>

                    </tr>
                </thead>
                <tbody id="dataWisata">
                <?php 
            	$no =1;
                  if( !empty($data)){ 
            		foreach($data as $data){
            	?>
            	    	<tr>
                    	<td><?=$no?></td>	
                    	<td><?=$data->nama_tempat_wisata?></td>
                    	<td><?=$data->lokasi?></td>
                    	<td><?=$data->jenis_wisata?></td>
                    	<td><?=$data->harga_tiket?></td>
                    	<td><?=$data->deskripsi_wisata?></td>
                    	<td><img src="<?=base_url()?>images/top-destination/<?=$data->foto_wisata?>" width="230px" height="200px"></td>
            			<td>
            				<button type="button" onclick="edit_data(<?=$data->id_wisata?>)" name="edit" class="btn btn-primary"><i class="fa fa-edit" title="Edit"></i></button>
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
                   Form Tambah Data Wisata
                </h4>
            </div>
            <div class="modal-body">
                
				        <form id="formTambah" action="" method="POST" enctype="multipart/form-data"> 
				
						<div class="form-group">
							<input type="text" name="nama" class="form-control fc-form" placeholder="Nama Wisata" id="nama"/>
						</div>

						<div class="form-group">
							<textarea name="lokasi" rows="6" class="form-control fc-form" placeholder="Lokasi Wisata" id="lokasi"></textarea>
						</div>
						
						<div class="form-group">
							<select name="jenis" rows="6" class="form-control" id="jenis">
							<?php 
								if( !empty($data_jenis)){ 
								foreach($data_jenis as $data_jenis){
							?>
								<option value="<?=$data_jenis->id_jenis_wisata?>">
									<div id="jenisP"><?=$data_jenis->jenis_wisata?></div>
								</option>
							<?php	
									} 
								} 
							?>
							</select>
							<button type="button" style="margin:6px 0 0 0;" data-toggle="modal" data-target="#ModalTambahJenis" name="tambahjenis" class="btn btn-primary"/>+</button>
						</div>

						<div class="form-group">
							<input type="text" name="map" class="form-control fc-form" placeholder="GMap Link" id="map"/>
						</div>

						<div class="form-group">
							<input type="number" name="harga" class="form-control fc-form" placeholder="Harga Tiket" id="harga"/>
						</div>
						
						<div class="form-group">
							<textarea name="deskripsi" rows="6" class="form-control fc-form" placeholder="Tentang Wisata" id="deskripsi"></textarea>
						</div>						
						
							<input type="file" name="foto" class="form-control-file fc-form" id="foto"/>
						
              
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


<!-- Form Tambah Jenis !-->

<div class="modal fade" id="ModalTambahJenis" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                   Form Tambah Data Jenis Wisata
                </h4>
            </div>
            <div class="modal-body">
                
				        <form id="formTambahJenis" action="" method="POST"> 
				
						<div class="form-group">
							<input type="text" name="namajeniswisata" class="form-control fc-form" placeholder="Nama Jenis Wisata" id="namajeniswisata"/>
						</div>
						              
            </div>
			<div class="modal-footer">
				<div class="form-group">
					<button onclick="tambah_data_jenis()" type="button" name="submit" class="btn btn-success" data-dismiss="modal"/>SIMPAN</button>
					<input type="reset" name="reset" class="btn btn-danger" value="ULANG" />
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
                   Form Edit Data Wisata
                </h4>
            </div>
            <div class="modal-body">
                
				        <form id="formedit" action="" method="POST" enctype="multipart/form-data"> 
						
							<input type="hidden" name="idED" id="idED" />
				
						<div class="form-group">
							<label style="color:#3e3c3c">Nama Wisata</label>
							<input type="text" name="namaED" class="form-control fc-form" placeholder="Nama Wisata" id="namaED"/>
						</div>

						<div class="form-group">
							<label style="color:#3e3c3c">Lokasi</label>
							<textarea name="lokasiED" rows="6" class="form-control fc-form" placeholder="Lokasi Wisata" id="lokasiED"></textarea>
						</div>
						
						<div class="form-group">
							<label style="color:#3e3c3c">Jenis Wisata</label>
							<select name="jenisED" rows="6" class="form-control" id="jenisED">

							</select>
							<button type="button" style="margin:6px 0 0 0;" data-dismiss="modal" data-toggle="modal" data-target="#ModalTambahJenis" name="tambahjenis" id="tambahjenis" class="btn btn-primary"/>+</button>
						</div>

						<div class="form-group">
							<label style="color:#3e3c3c">Gmap Link</label>
							<input type="text" name="mapED" class="form-control fc-form" placeholder="GMap Link" id="mapED"/>
						</div>

						<div class="form-group">
							<label style="color:#3e3c3c">Harga Tiket</label>
							<input type="number" name="hargaED" class="form-control fc-form" placeholder="Harga Tiket" id="hargaED"/>
						</div>
						
						<div class="form-group">
							<label style="color:#3e3c3c">Deskripsi Wisata</label>
							<textarea name="deskripsiED" rows="6" class="form-control fc-form" placeholder="Tentang Wisata" id="deskripsiED"></textarea>
						</div>		
							<label style="color:#3e3c3c">Foto Wisata</label><br>
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
	
</div>
</div>
</body>
</html>
