<?php
$title['title'] = 'Data Pembayaran';
$this->load->view('header-admin',$title);
?>

<script>
$(document).ready(function(){
 $('#wait').hide();
 $('#loading-wrap').hide();
 
  });


function valid(id){
	if(confirm("Apakah Yakin Ingin Validasi Pembayaran ini ?")){
	  $('#wait').show();
	  $('#loading-wrap').show();
	  
		$.ajax({
		type: "POST", 
		url: "<?php echo base_url(); ?>"+"Pembayarandata/valid/"+id,
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
                    	<th>Atas Nama Pengirim</th>
                    	<th>Bukti Pembayaran</th>
                    	<th>Tanggal Upload</th>
                    	<th>Total Yang Harus Dibayar</th>
                    	<th>Status Pembayaran</th>

                    </tr>
                </thead>
                <tbody id="dataHotel">
                <?php 
            	$no = 1;
                  if( !empty($data)){ 
            		foreach($data as $data){
            		?>
            	    	<tr>
                    	<td><?=$no?></td>	
                    	<td><?=$data->id_booking?></td>
                    	<td><?=$data->atas_nama_pengirim?></td>
                    	<td><img src="<?=base_url()?>images/pembayaran/<?=$data->bukti_transaksi?>" width="200px" height="260px"></td>
                    	<td><?=$data->tgl_upload_bukti?></td>
                    	<td><?=($data->biaya_traveling)+($data->biaya_tambahan)?></td>
                    	<td>
							<?php if($data->status_valid){
								echo "<b>TERVALIDASI</b>";
							}else{
								?><button type='button' onclick='valid(<?=$data->id_pembayaran?>)' name='cancel' class='btn btn-primary'><i class='fa fa-check-square' title='Biaya Tambahan'></i></button>
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
