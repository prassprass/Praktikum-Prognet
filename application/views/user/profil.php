
<body>
<?php
  $title['title'] = 'User';
  $this->load->view('header',$title);
 
 ?>
<script>

  function cari(id_book){
  
	  $.ajax({
		 type: "GET", 
		 url: "<?php echo base_url(); ?>"+"Pembayaran/cari_booking/"+id_book,
		 dataType : "json", 
		 success: function(data) {
			
				$("#nama_user").val(data.data[0].nama_user);
				
				$("#id_book").val(data.data[0].id_booking);
				
				$("#biaya_traveling").val(data.data[0].biaya_traveling);
				
				if(data.data[0].biaya_tambahan==null) $("#biaya_tambahan").val("0");
				else $("#biaya_tambahan").val(data.data[0].biaya_tambahan);
				
				if(data.data[0].ket_biaya_tambahan==null) $("#ket_biaya_tambahan").val("-");
				else $("#ket_biaya_tambahan").val(data.data[0].ket_biaya_tambahan);
				
				if(data.data[0].biaya_tambahan==null) $("#total").val(data.data[0].biaya_traveling);
				else $("#total").val( parseInt(data.data[0].biaya_traveling)+ parseInt(data.data[0].biaya_tambahan));

				
						$('#wait').hide();
						$('#loading-wrap').hide(); 
						$('#ModalBayar').modal(); 

				}

		 });
	}
	
    function pembayaran(){
			
		if(document.forms["formPembayaran"].atas_nama.value==="")alert('Isikan Kolom Atas Nama');
		else if(document.forms["formPembayaran"].bukti.value==="")alert('Masukan Bukti Pembayaran');
		else{
		
		  $('#wait').show();
		  $('#loading-wrap').show();
		  
		     var form = new FormData(document.getElementById("formPembayaran"));
			  form.append('bukti',$('#bukti')[0].files[0]);
			  form.append('atas_nama ',$('#atas_nama').val());

		   $.ajax({
		   
			type: "POST", 
			url: "<?php echo base_url(); ?>"+"Pembayaran/pembayaran",
			mimeType: "multipart/form-data",
			datatype : "json", 
			data: form,
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false, 			// To send DOMDocument or non processed data file it is set to false
			success: function(msg) {
				if(msg=="success"){
					  $("#myModalSuccess").modal();
					  $("#ModalBayar").hide();
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
	}	
	
</script>

<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 align="center" style="margin: 140px 0 50px 0"><B>RENCANA PERJALANAN </B></h3>
        </div>
		
           <div class="box-body">
            <div class="table-responsive">
            <table id="table_booking" class="table">
            	<thead>
                	<tr>
                    	<th>ID Booking</th>
                    	<th>Banyak Traveller</th>
                    	<th>Tanggal Booking</th>
                    	<th>Nama Paket</th>
                    	<th>Tanggal Travelling</th>
                    	<th>Permintaan Spesial</th>
                    	<th>Biaya Travelling</th>
                    	<th>Biaya Tambahan</th>
                    	<th>Ket Biaya Tambahan</th>
                    	<th>Status Pembayaran</th>
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
                    	<td><?=$data->id_booking?></td>
                    	<td><?=$data->banyak_traveler?></td>
                    	<td><?=$data->tgl_booking?></td>
                    	<td><?=$data->nama_paket?></td>
                    	<td><?=$data->tgl_traveling?></td>
                    	<td><?=($data->permintaan_spesial)?$data->permintaan_spesial:"-"?></td>
                    	<td><?=$data->biaya_traveling?></td>
                    	<td><?=($data->biaya_tambahan)?$data->biaya_tambahan:"0"?></td>
                    	<td><?=($data->ket_biaya_tambahan)?$data->ket_biaya_tambahan:"-"?></td>
                    	<td>
							<?php if($data->status_cancle==1){
								echo "";
							}else{
								if($data->status_pembayaran==1){
									echo "<br>Lunas";
								}else if ($data->status_pembayaran==0){
									echo "<br>Menunggu";
								}else{
									echo "<br>Belum dibayar";
								}
							}								
							?>
						</td>
						<td>
						<?php if($data->status_cancle){
							echo "<b><br>DIBATALKAN</b>";
						}else if($data->status_pembayaran==0){ ?>
							<br><button type='button' onclick='cancel(<?=$data->id_booking?>)' name='cancel' class='btn btn-danger'><i class='fa fa-ban' title='Pembatalan'></i></button><br><br>
						<?php }else if($data->status_pembayaran==1){ ?>
							<br><button type='button' onclick='cancel(<?=$data->id_booking?>)' name='cancel' class='btn btn-danger'><i class='fa fa-ban' title='Pembatalan'></i></button><br><br>
						<?php }else{ ?>
							<br><button type='button' onclick='cancel(<?=$data->id_booking?>)' name='cancel' class='btn btn-danger'><i class='fa fa-ban' title='Pembatalan'></i></button><br><br>						
							<button type='button' onclick='edit_data(<?=$data->id_booking?>)' name='cancel' class='btn btn-primary'><i class='fa fa-table' title='Ganti Tanggal'></i></button><br><br>
							<button class="btn btn-success" name="bayar" onclick="cari(<?=$data->id_booking?>)" /><i class='fa fa-credit-card' title='Pembayaran'></i></button><br><br>
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



<div class="modal fade" id="ModalBayar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
					  Data Booking <b id="HotelPaket"></b>
					</h4>
				</div>
				<div class="modal-body">
					
				    <form id="dataBooking" action="" method="POST"> 
						<div class="form-group">
							<div class="form-group">
								<div class="input-group">
									<input type="text" id="nama_user" class="form-control form1" readonly>
									<span class="input-group-addon igd"><i class="fa fa-user" style="width:10px"></i></span>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<input type="text" id="biaya_traveling" class="form-control form1" readonly>
									<span class="input-group-addon igd"><i class="fa fa-usd" style="width:10px"></i></span>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<input type="text" id="biaya_tambahan" class="form-control form1" readonly>
									<span class="input-group-addon igd"><i class="fa fa-usd" style="width:10px"></i></span>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<textarea id="ket_biaya_tambahan" class="form-control form1" readonly></textarea>
									<span class="input-group-addon igd"><i class="fa fa-book" style="width:10px"></i></span>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<input type="text" id="total" class="form-control form1" readonly>
									<span class="input-group-addon igd"><i class="fa fa-usd" style="width:10px"></i></span>
								</div>
							</div>
						</div>		
					</form>
						
					<form id="formPembayaran" action="" method="POST" enctype="multipart/form-data"> 
						<div class="form-group">
							<input type="hidden" name="id_book" id="id_book">
							
							<div class="form-group">
								<div class="input-group">
									<input type="text" name="atas_nama" id="atas_nama" class="form-control form1" placeholder="Atas Nama Pengirim">
									<span class="input-group-addon igd"><i class="fa fa-credit-card"></i></span>
								</div>
							</div>
							
							<label style="color:#77707e">Bukti Transaksi</label>
							<input type="file" name="bukti" id="bukti">


							<div class="form-group">
								<button type="button" class="btn btn-danger" name="kirim" id="kirim" onclick="pembayaran()" style="margin-top:20px; width:100%; background-color:f0565a;"/>KIRIM</button>

							</div>
						</div>	
					</form>	
					
										  
				</div>
				<div class="modal-footer">
					<div class="form-group" id="load_hotel">
						
					</div>
				</div>			
			</div>
		</div>
	</div>	
	

	
  <!-- Modal Sukses -->
  <div class="modal fade" id="myModalSuccess" role="dialog" >
    <div class="modal-dialog" >
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body custom-body">
        	<img align="center" src="<?=base_url()?>images/icon/success.png" class="img-responsive center-block"  width="30%">
        		<h2 align="center" style="color:#232323">BERHASIL</h2>
        		<h5 align="center" style="color:#77707e">Apabila bukti pembayaran telah divalidasi oleh admin<br>maka voucer akan dikirimkan ke email anda</h5>
          		
        </div>
        <div class="modal-footer">
			 <a href="<?=base_url("User/profil/")?><?=$this->session->userdata('id_user')?>">
				<button type="button" class="close">
                    OK 
                </button>
        </div>
      </div>
      
    </div>
  </div>
	
  <!-- Modal Error -->
  <div class="modal fade" id="myModalFail" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <!-- <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
       
        </div> -->
        <div class="modal-body custom-body">
        	<img src="<?=base_url()?>images/icon/error.png" style="width: 150px; height: 150px;" class="img-responsive center-block">
        		<h2 align="center">Error!</h2>
          		<p align="center">Gagal Melakukan Aksi</p>
        </div>
        <div class="modal-footer">
			    <button type="button" class="close" 
                   data-dismiss="modal">
                    OK 
                </button>
        </div>
      </div>
      
    </div>
  </div>
 
<div class="clearfix"></div>
<?php $this->load->view('footer'); ?>

<!--file JS-->

<script type="text/javascript">
	$(window).on('load', function() {
        $('#status').fadeOut();
        $('#preloader').delay(120).fadeOut('slow');
    });
</script>
</body>
</html>