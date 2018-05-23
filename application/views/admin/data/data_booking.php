<?php
$title['title'] = 'Data Booking';
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
   
function edit_data(id_booking){

	$.ajax({
	type: "GET", 
	url: "<?php echo base_url(); ?>"+"Bookingdata/edit/"+id_booking,
	dataType : "json",
	success: function(data) {
		 document.getElementById("formedit").id.value=data.data_edit.id_booking;
		 document.getElementById("formedit").biaya.value=data.data_edit.biaya_tambahan;
		 document.getElementById("formedit").ket.value=data.data_edit.ket_biaya_tambahan;
			  
			$("#ModalBiaya").modal();		 
	  }
   });

}	

function update_data(){


  $('#wait').show();
  $('#loading-wrap').show();
  
   $.ajax({
	type: "POST", 
	url: "<?php echo base_url(); ?>"+"Bookingdata/update",
	datatype : "json", 
	data: $("#formedit").serialize(), 
	success: function(data) {
		if(data=="success"){

			  $('#wait').hide();
			  $('#loading-wrap').hide();
				location.reload();
			
		}else{
			  $("#myModalFail").modal();
			  $('#wait').hide();
			  $('#loading-wrap').hide();
		}
	   }
	 }); 
}	

function cancel(id_booking){
	if(confirm("Apakah Yakin Ingin Membatalkan Pesanan ini ?")){
	  $('#wait').show();
	  $('#loading-wrap').show();
	  
		$.ajax({
		type: "POST", 
		url: "<?php echo base_url(); ?>"+"Bookingdata/cancel/"+id_booking,
		success: function(data) {
			if(data=="success"){
				 $('#wait').hide();
				 $('#loading-wrap').hide();
				location.reload();
			}else{
				  $("#myModalFail").modal();
				  $('#wait').hide();
				  $('#loading-wrap').hide();
				}		
			  }
			});	
		}	
}		

</script>



<div class="page-wrapper">
        <div class="page-header">
            <h3>Data Wisata <small>Data Wisata</small></h3>
		</div>

        <ul class="breadcrumb">
            <li><a href='<?php echo base_url("Bookingdata"); ?>'>View Data</a></li>
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
            <table id="table_booking" class="table table-bordered">
            	<thead>
                	<tr>
                    	<th>No</th>
                    	<th>ID Booking</th>
                    	<th>Nama User</th>
                    	<th>Banyak Traveller</th>
                    	<th>Tanggal Booking</th>
                    	<th>Nama Paket</th>
                    	<th>Tanggal Travelling</th>
                    	<th>Permintaan Spesial</th>
                    	<th>Biaya Travelling</th>
                    	<th>Biaya Tambahan</th>
                    	<th>Ket Biaya Tambahan</th>
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
                    	<td><?=$data->id_booking?></td>
                    	<td><?=$data->nama_user?></td>
                    	<td><?=$data->banyak_traveler?></td>
                    	<td><?=$data->tgl_booking?></td>
                    	<td><?=$data->nama_paket?></td>
                    	<td><?=$data->tgl_traveling?></td>
                    	<td><?=($data->permintaan_spesial)?$data->permintaan_spesial:"-"?></td>
                    	<td><?=$data->biaya_traveling?></td>
                    	<td><?=($data->biaya_tambahan)?$data->biaya_tambahan:"0"?></td>
                    	<td><?=($data->ket_biaya_tambahan)?$data->ket_biaya_tambahan:"-"?>
						</td>
						<td>
						<?php if($data->status_cancle){
							echo "<b>DIBATALKAN</b>";
						}else{
							?><button type='button' onclick='cancel(<?=$data->id_booking?>)' name='cancel' class='btn btn-danger'><i class='fa fa-ban' title='Pembatalan'></i></button>
							<button type='button' onclick='edit_data(<?=$data->id_booking?>)' name='cancel' class='btn btn-primary'><i class='fa fa-edit' title='Biaya Tambahan'></i></button>
						<?php } ?>
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
    </div>
    </section>
	

<!-- Form  edit !-->

<div class="modal fade" id="ModalBiaya" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                
				        <form id="formedit" action="" method="POST"> 
						
							<input type="hidden" name="id" id="id" />
				
						<div class="form-group">
							<label style="color:#3e3c3c">Biaya Tambahan</label>
							<input type="text" name="biaya" class="form-control fc-form" placeholder="Biaya Tambahan" id="biaya"/>
						</div>
						
						<div class="form-group">
							<label style="color:#3e3c3c">Keterangan</label>
							<textarea name="ket" rows="6" class="form-control fc-form" placeholder="Keterangan Biaya Tambahan" id="ket"></textarea>
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
