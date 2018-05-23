<html>
<head>
	<title>Pembayaran | Travel N Tour</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/dashboard-admin/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/dashboard-admin/css/style-admin.css" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/dashboard-admin/font-awesome/css/font-awesome.min.css" />

	<link rel="shortcut icon" href="<?=base_url()?>image/fav.png">
</head>

<!--file JS-->
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(window).on('load', function() {
        $('#status').fadeOut();
        $('#preloader').delay(120).fadeOut('slow');
    });

    $(window).load(function(){
    	$('.flexslider').flexslider({
    		animation: "fade"
    	});
    });



$(document).ready(function(){
 $('#wait').hide();
 $('#loading-wrap').hide();
 
  });
  
  function cari(){
	var id_book = $('#id_booking').val();
	
	
	  if(id_book==""){
			alert("Masukan ID Booking");
	  
	  }else{	
  
		  $.ajax({
			 type: "GET", 
			 url: "<?php echo base_url(); ?>"+"Pembayaran/cari_booking/"+id_book,
			 dataType : "json", 
			 success: function(data) {
			 	
				if(data.data.length > 0){
						if(data.data[0].status_pembayaran==2){ 
							alert("Booking Telah Dibayar");
						}
						else if(data.data[0].status_cancle==1){
							alert("Booking Telah Dibatalkan");
						}						
						else{
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
					
					}else{
						alert("ID Booking tidak ditemukan");
					}
				
				}

			 });
		}
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
<body>


	<div class="container">
	   <div class="row">
		<div class="head-form ">Pembayaran</div	>
			<div class="col-md-4 col-md-offset-4 custom-form">
				<div class="login-img">
				</div>

				<hr class="uline">

				<div class="form-group">
					<div class="input-group">
						<input type="text" name="id_booking" id="id_booking" class="form-control form1" placeholder="Cari ID booking ...">
						<span class="input-group-addon igd">ID</span>
					</div>
				</div>

				<div class="form-group">
					<button class="btn-block btn-login" name="cari" onclick="cari()" />CARI</button>
				</div>
				</form>
			</div>
		</div>
	</div>

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
								<button type="button" class="btn-block btn-login" name="kirim" id="kirim" onclick="pembayaran()" style="margin-top:20px"/>KIRIM</button>

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
			 <a href="<?=base_url()?>">
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
	

</body>
</html>