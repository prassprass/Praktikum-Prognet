<?php
$title['title'] = 'Data Hotel';
$this->load->view('header-admin',$title);
?>

<script>
$(document).ready(function(){
 $('#wait').hide();
 $('#loading-wrap').hide();

  });
  
  
  
	function reload(){
	
	/*
		  var a = $('#table_content').dataTable({
				"bJQueryUI": true,
				"bServerSide": true,
				"sAjaxSource": "<?php echo base_url(); ?>"+"Hotel/load_data"
			});
				a.fnDraw();
	*/

  $.ajax({
     type: "GET", 
     url: "<?php echo base_url(); ?>"+"Hotel/load_data",
	 dataType : "json", 
     success: function(data) {
     var i = 0;
		$("#dataHotel").empty()
		while (i < data.data.length) {
	 
			 //document.getElementById("dataHotel").rows[i].cells[0].innerHTML=data.data[i].nama_hotel;
			 //document.getElementById("dataHotel").rows[i].cells[0].innerHTML=data.data[i].alamat_hotel;
			 //document.getElementById("dataHotel").rows[i].cells[0].innerHTML=data.data[i].tlpn_hotel;
			 //document.getElementById("dataHotel").rows[i].cells[0].innerHTML=data.data[i].biaya_permalam;
	     
		 	$("#dataHotel").append("<tr><td>"+(i+1)+"</td><td>"+data.data[i].nama_hotel+"</td><td>"+data.data[i].alamat_hotel+"</td><td>"+data.data[i].tlpn_hotel+"</td><td>"+data.data[i].biaya_permalam+"</td><td><button type='button' onclick='edit_data("+data.data[i].id_hotel+")' name='edit' class='btn btn-primary'><i class='fa fa-edit' title='Edit'></i></button><button type='button' onclick='hapus_data("+data.data[i].id_hotel+")' name='hapus' class='btn btn-danger'><i class='fa fa-trash' title='hapus' ></i></button></td></tr>");
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
	else if(document.forms["formTambah"].alamat.value==="")alert('Isikan Kolom Alamat')	
	else if(document.forms["formTambah"].tlpn.value==="")alert('Isikan Kolom Telepon')
	else if(document.forms["formTambah"].biaya.value==="")alert('Isikan Kolom Biaya Per Malam Dengan Angka')
	else{
	
	  $('#wait').show();
      $('#loading-wrap').show();
	  
       $.ajax({
        type: "POST", 
        url: "<?php echo base_url(); ?>"+"Hotel/tambah_hotel",
        datatype : "json", 
        data: $("#formTambah").serialize(), 
        success: function(data) {
			if(data=="success"){
				  $("#myModalSuccess").modal();
				  $('#wait').hide();
				  $('#loading-wrap').hide();
				   
				document.forms["formTambah"].nama.value="";
				document.forms["formTambah"].alamat.value="";
				document.forms["formTambah"].tlpn.value="";
				document.forms["formTambah"].biaya.value="";
				   
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
	
        $.ajax({
        type: "GET", 
        url: "<?php echo base_url(); ?>"+"Hotel/edit/"+id_edit,
        dataType : "json",
        success: function(data) {
			 document.getElementById("formedit").idED.value=data.data_edit.id_hotel;
			 document.getElementById("formedit").namaED.value=data.data_edit.nama_hotel;
			 document.getElementById("formedit").alamatED.value=data.data_edit.alamat_hotel;
			 document.getElementById("formedit").tlpnED.value=data.data_edit.tlpn_hotel;
			 document.getElementById("formedit").biayaED.value=data.data_edit.biaya_permalam;
				  
				$("#ModalEdit").modal();		 
          }
       });

	}	

    function update_data(){
			
	if(document.forms["formedit"].namaED.value==="")alert('Isikan Kolom Nama')
	else if(document.forms["formedit"].alamatED.value==="")alert('Isikan Kolom Alamat')	
	else if(document.forms["formedit"].tlpnED.value==="")alert('Isikan Kolom Telepon')
	else if(document.forms["formedit"].biayaED.value==="")alert('Isikan Kolom Biaya Per Malam Dengan Angka')
	else{
	
	  $('#wait').show();
      $('#loading-wrap').show();
	  
       $.ajax({
        type: "POST", 
        url: "<?php echo base_url(); ?>"+"Hotel/update",
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
	   }
	}
	
   function hapus_data(id_del){
	  $('#wait').show();
      $('#loading-wrap').show();
	  
	 // preventDefault();
	  
       $.ajax({
        type: "POST", 
        url: "<?php echo base_url(); ?>"+"Hotel/delete",
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
	

</script>



<div class="page-wrapper">
        <div class="page-header">
            <h3>Data Hotel <small>Data Hotel</small></h3>
		</div>

        <ul class="breadcrumb">
            <li><a href='<?php echo base_url("Hotel"); ?>'>View Data</a></li>
            <li><a href=''>Tambah Content</a></li>
            <li><a href=''>Edit Content</a></li>
            <li><a href=''>Hapus Content</a></li>
        </ul>
 
    <div style="color: red;"><?php echo validation_errors(); ?></div>

	
	 <section class="content">
    <div class="box">
        <div class="box-header">
            <h3>Data Hotel <small>Overview</small></h3>
        </div>
		

        <div class="box-body">
            <div class="table-responsive">
            <table id="table_content" class="table table-bordered">
            	<thead>
                	<tr>
                    	<th>No</th>
                    	<th>Nama Hotel</th>
                    	<th>Alamat Hotel</th>
                    	<th>Telepon Hotel</th>
                    	<th>Biaya Per Malam</th>
                    	<th>Aksi</th>

                    </tr>
                </thead>
                <tbody id="dataHotel">
                <?php 
            	$no =1;
                  if( !empty($data)){ 
            		foreach($data as $data){
            		?>
            	    	<tr>
                    	<td><?=$no?></td>	
                    	<td><?=$data->nama_hotel?></td>
                    	<td><?=$data->alamat_hotel?></td>
                    	<td><?=$data->tlpn_hotel?></td>
                    	<td><?=$data->biaya_permalam?></td>
            			<td>
            				<button type="button" onclick="edit_data(<?=$data->id_hotel?>)" name="edit" class="btn btn-primary"><i class="fa fa-edit" title="Edit"></i></button>
            				<button type="button" onclick="hapus_data(<?=$data->id_hotel?>)" name="hapus" class="btn btn-danger"><i class="fa fa-trash" title="hapus" ></i></button>
							
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


<div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                   Form Tambah Data Hotel
                </h4>
            </div>
            <div class="modal-body">
                
				        <form id="formTambah" action="" method="POST"> 
				
						<div class="form-group">
							<input type="text" name="nama" class="form-control fc-form" placeholder="Nama Hotel" id="nama"/>
						</div>

						<div class="form-group">
							<textarea name="alamat" rows="6" class="form-control fc-form" placeholder="Alamat Hotel" id="alamat"></textarea>
						</div>

						<div class="form-group">
							<input type="text" name="tlpn" class="form-control fc-form" placeholder="Telepon Hotel" id="tlpn"/>
						</div>

						<div class="form-group">
							<input type="number" name="biaya" class="form-control fc-form" placeholder="Biaya Per Malam" id="biaya"/>
						</div>

              
            </div>
			<div class="modal-footer">
				<div class="form-group">
					<button onclick="tambah_data()" type="button" name="submit" class="btn btn-success" data-dismiss="modal"/>SIMPAN</button>
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
                   Form Edit Data Hotel
                </h4>
            </div>
            <div class="modal-body">
                
				        <form id="formedit" action="" method="POST"> 
						
							<input type="hidden" name="idED" id="idED" />
							
						<div class="form-group">
							<label style="color:#3e3c3c">Nama Hotel</label>
							<input type="text" name="namaED" class="form-control fc-form" placeholder="Nama Hotel" id="namaED" />
						</div>

						<div class="form-group">
							<label style="color:#3e3c3c">Alamat Hotel</label>
							<textarea name="alamatED" rows="6" class="form-control fc-form" placeholder="Alamat Hotel" id="alamatED" ></textarea>
						</div>

						<div class="form-group">
							<label style="color:#3e3c3c">Telepon Hotel</label>
							<input type="text" name="tlpnED" class="form-control fc-form" placeholder="Telepon Hotel" id="tlpnED" />
						</div>

						<div class="form-group">
							<label style="color:#3e3c3c">Biaya Per Malam</label>
							<input type="number" name="biayaED" class="form-control fc-form" placeholder="Biaya Per Malam" id="biayaED" />
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
