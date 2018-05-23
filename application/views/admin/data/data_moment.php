<?php
$title['title'] = 'Data Moment';
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
     url: "<?php echo base_url(); ?>"+"Momentdata/load_data",
	 dataType : "json", 
     success: function(data) {
     var i = 0;
		$("#dataMoment").empty()
		while (i < data.data.length) {
	 
		 	$("#dataMoment").append('<tr><td>'+(i+1)+'</td>'
			 +'<td>'+data.data[i].judul_moment+'</td>'
			 +'<td>'+data.data[i].lokasi_moment+'</td>'
			 +'<td>'+data.data[i].tanggal_moment+'</td>'
			 +'<td>'+data.data[i].deskripsi_moment+'</td>'
			 +'<td><img src="<?=base_url()?>images/moment/'+data.data[i].foto_moment+'" width="230px" height="200px"></td>'
			 +'<td><button type="button" onclick="edit_data('+data.data[i].id_moment+')" name="edit" class="btn btn-primary"><i class="fa fa-edit" title="Edit"></i></button></td></tr>');
				i+=1;
             }
			$('#wait').hide();
			$('#loading-wrap').hide(); 
			$("#myModalSuccess").hide();
          }

       });

 }
 
	
    function tambah_data(){
			
		if(document.forms["formTambah"].nama.value==="")alert('Isikan Kolom Judul Moment')
		else if(document.forms["formTambah"].lokasi.value==="")alert('Isikan Kolom Lokasi Moment')	
		else if(document.forms["formTambah"].tanggal.value==="")alert('Isikan Kolom taggal Moment')	
		else if(document.forms["formTambah"].deskripsi.value==="")alert('Isikan Kolom Deskripsi Moment')
		else if(document.forms["formTambah"].foto_moment.value==="")alert('Masukan Foto Wisata Moment')
		else{
		
		  $('#wait').show();
		  $('#loading-wrap').show();
		  
		     var form = new FormData(document.getElementById("formTambah"));
			  form.append('foto_moment)',$('#foto_moment')[0].files[0]);
			  form.append('nama ',$('#nama').val());
			  form.append('lokasi ',$('#lokasi').val());
			  form.append('deskripsi ',$('#deskripsi').val());

		  
		   $.ajax({

		   
			type: "POST", 
			url: "<?php echo base_url(); ?>"+"Momentdata/tambah_wisata",
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
						document.forms["formTambah"].lokasi.value="";
						document.forms["formTambah"].tanggal.value="";
						document.forms["formTambah"].deskripsi.value="";
						document.forms["formTambah"].foto_moment.value="";
						
				}else{
					  $("#myModalFail").modal();
					  $('#wait').hide();
					  $('#loading-wrap').hide();
				}
			   }
			 }); 
		   }
	}

	 function edit_data(id_edit){
   
   $("#deskripsiED").empty()
	   $.ajax({
	   type: "GET", 
	   url: "<?php echo base_url(); ?>"+"Momentdata/edit/"+id_edit,
	   dataType : "json",
	   success: function(data) {
			document.getElementById("formedit").idED.value=data.data_edit.id_moment;
			document.getElementById("formedit").namaED.value=data.data_edit.judul_moment;
			document.getElementById("formedit").lokasiED.value=data.data_edit.lokasi_moment;
			document.getElementById("formedit").tanggalED.value=data.data_edit.tanggal_moment;
			document.getElementById("formedit").deskripsiED.value=data.data_edit.deskripsi_moment;
			document.getElementById("formedit").file_lama.value=data.data_edit.foto_moment;
			$("#image_lama").attr("src","<?=base_url()?>/images/moment/"+data.data_edit.foto_moment+"");
		   

		  
			   $("#ModalEdit").modal();		 
		 }
	  });

   }	



    function update_data(){
			
		if(document.forms["formedit"].namaED.value==="")alert('Isikan Kolom Judul Moment')
		else if(document.forms["formedit"].lokasiED.value==="")alert('Isikan Kolom Lokasi Moment')	
		else if(document.forms["formedit"].tanggalED.value==="")alert('Isikan Kolom tanggal Moment')
		else if(document.forms["formedit"].deskripsiED.value==="")alert('Isikan Kolom Deskripsi Moment')
		else{
	
	  $('#wait').show();
      $('#loading-wrap').show();
	  
		if(document.forms["formedit"].fotomomentED.value===""){
	  
		   $.ajax({
			type: "POST", 
			url: "<?php echo base_url(); ?>"+"Momentdata/update_without_image",
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
			  formED.append('fotomomentED',$('#fotomomentED')[0].files[0]);
			  formED.append('idED ',$('#idED').val());
			  formED.append('namaED ',$('#namaED').val());
			  formED.append('tanggalED ',$('#tanggalED').val());
			  formED.append('lokasiED ',$('#lokasiED').val());
			  formED.append('deskrisiED ',$('#deskripsiED').val());
			  formED.append('file_lama ',$('#file_lama').val());

		  
		   $.ajax({

		   
			type: "POST", 
			url: "<?php echo base_url(); ?>"+"Momentdata/update_with_image",
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
            <h3>Data Moment <small>Overview</small></h3>
        </div>
		

        <div class="box-body">
            <div class="table-responsive">
            <table id="table_content" class="table table-bordered">
            	<thead>
                	<tr>
                    	<th>No</th>
                    	<th>Judul Moment</th>
                    	<th>Lokasi Moment</th>
                    	<th>Tanggal Moment</th>
                    	<th>Deskripsi Moment</th>
                    	<th>Foto Moment</th>
                    	<th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="dataMoment">
                <?php 
            	$no =1;
                  if( !empty($data)){ 
            		foreach($data as $data){
            	?>
            	    	<tr>
                    	<td><?=$no?></td>	
                    	<td><?=$data->judul_moment?></td>
                    	<td><?=$data->lokasi_moment?></td>
                    	<td><?=$data->tanggal_moment?></td>
                    	<td><?=$data->deskripsi_moment?></td>
                    	<td><img src="<?=base_url()?>images/moment/<?=$data->foto_moment?>" width="230px" height="200px"></td>
            			<td>
            				<button type="button" onclick="edit_data(<?=$data->id_moment?>)" name="edit" class="btn btn-primary"><i class="fa fa-edit" title="Edit"></i></button>
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
                   Form Tambah Data Moment
                </h4>
            </div>
            <div class="modal-body">
                
				        <form id="formTambah" action="" method="POST" enctype="multipart/form-data"> 
				
						<div class="form-group">
							<input type="text" name="nama" class="form-control fc-form" placeholder="Judul Moment" id="nama"/>
						</div>

						<div class="form-group">
							<textarea name="lokasi" rows="6" class="form-control fc-form" placeholder="Lokasi Moment" id="lokasi"></textarea>
						</div>
						<div class="form-group">
							<input type="date" name="tanggal" rows="6" class="form-control fc-form" placeholder="Tanggal" id="tanggal">
						</div>	

						<div class="form-group">
							<textarea name="deskripsi" rows="6" class="form-control fc-form" placeholder="Deskripsi" id="deskripsi"></textarea>
						</div>						
						
							<input type="file" name="foto_moment" class="form-control-file fc-form" id="foto_moment"/>
						
              
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
                   Form Edit Moment
                </h4>
            </div>
            <div class="modal-body">
                
				        <form id="formedit" action="" method="POST" enctype="multipart/form-data"> 
						
							<input type="hidden" name="idED" id="idED" />
				
						<div class="form-group">
							<input type="text" name="namaED" class="form-control fc-form" placeholder="Judul Moment" id="namaED"/>
						</div>

						<div class="form-group">
							<textarea name="lokasiED" rows="6" class="form-control fc-form" placeholder="Lokasi Moment" id="lokasiED"></textarea>
						</div>
						<div class="form-group">
							<input type="date" name="tanggalED" rows="6" class="form-control fc-form" placeholder="Tanggal Moment" id="tanggalED">
						</div>
						
						
						<div class="form-group">
							<textarea name="deskripsiED" rows="6" class="form-control fc-form" placeholder="Deskripsi Moment" id="deskripsiED"></textarea>
						</div>						
							<img src="" id="image_lama" width="100">
							<input name="file_lama" type="text" id="file_lama" hidden> 
							<input type="file" name="fotomomentED" class="form-control-file fc-form" id="fotomomentED"/>
						
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
