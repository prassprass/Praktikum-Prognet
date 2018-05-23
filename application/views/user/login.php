<!DOCTYPE html>
<html>
	<head>
		<title>Login | Travel N Tour</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/dashboard-admin/datatables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/dashboard-admin/datatables/dataTables.bootstrap.min.js"></script>
		<script src="assets/js/jquery.flexslider-min.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/js/jquery-ui.js" type="text/javascript"></script>
		
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/dashboard-admin/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/dashboard-admin/css/style-admin.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/dashboard-admin/font-awesome/css/font-awesome.min.css" />

		<link rel="shortcut icon" href="<?=base_url()?>image/fav.png">
	
	<script>
		$(document).ready(function(){
		 $('#wait').hide();
		 $('#loading-wrap').hide();

		  });
		  
	    function daftar(){
			
		if(document.forms["formDaftar"].emailDaf.value==="")alert('Isikan Kolom Email')
		else if(document.forms["formDaftar"].passDaf.value==="")alert('Isikan Kolom Password')	
		else if(document.forms["formDaftar"].namaDaf.value==="")alert('Isikan Kolom Nama')
		else if(document.forms["formDaftar"].idDaf.value==="")alert('Isikan Kolom ID Dengan Angka')
		else if(document.forms["formDaftar"].tlpnDaf.value==="")alert('Isikan Kolom Telepon Dengan Angka')
		else if(document.forms["formDaftar"].alamatDaf.value==="")alert('Isikan Kolom Alamat')
		else{
		
		  $('#wait').show();
		  $('#loading-wrap').show();
		  
		   $.ajax({
			type: "POST", 
			url: "<?php echo base_url(); ?>"+"User/daftar",
			datatype : "json", 
			data: $("#formDaftar").serialize(), 
			success: function(data) {
				if(data=="success"){
					  $("#myModalSuccess").modal();
					  $('#wait').hide();
					  $('#loading-wrap').hide();
					   
					document.forms["formDaftar"].emailDaf.value="";
					document.forms["formDaftar"].passDaf.value="";
					document.forms["formDaftar"].namaDaf.value="";
					document.forms["formDaftar"].idDaf.value="";
					document.forms["formDaftar"].alamatDaf.value="";
					document.forms["formDaftar"].tlpnDaf.value="";
					   
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
		
	</head>
		<body>
		<!--Container-->
		<div class="container">
			<div class="row">
			<div class="head-form ">Tours n Travel</div	>
				<div class="col-md-4 col-md-offset-4 custom-form">
					<div class="login-img">
					</div>

					<hr class="uline">

					<?php echo form_open("User/login"); ?>
					<div class="form-group">
						<div class="input-group">
							<input type="text" name="email" class="form-control form1" placeholder="Email">
							<span class="input-group-addon igd"><i class="fa fa-user"></i></span>
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<input type="password" name="password" class="form-control form1" placeholder="Password">
							<span class="input-group-addon igd"><i class="fa fa-lock"></i></span>
						</div>
					</div>

					<div class="form-group">
						<input type="submit" class="btn-block btn-login" name="submit" value="MASUK" />
					</div>
					</form>
						
					<a href="#modalDaftar" data-toggle="modal" data-target="#modalDaftar" style="color:#3e3c3c">Daftar Sekarang </a>
					
				</div>
			</div>
		</div>

		<!-- Form  daftar !-->


		<div class="modal fade" id="modalDaftar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
						   Form Reegitrasi
						</h4>
					</div>
					<div class="modal-body">
						
								<form id="formDaftar" action="" method="POST"> 
						
								<div class="form-group">
									<input type="text" name="emailDaf" class="form-control fc-form" placeholder="Email" id="emailDaf"/>
								</div>

								<div class="form-group">
									<input type="password" name="passDaf" class="form-control fc-form" placeholder="Password" id="passDaf"/>
								</div>
								
								<div class="form-group">
									<input type="text" name="namaDaf" class="form-control fc-form" placeholder="Nama Lengkap" id="namaDaf"/>
								</div>
								
								<div class="form-group">
									<input type="number" name="idDaf" class="form-control fc-form" placeholder="No Identitas" id="idDaf"/>
								</div>
							
								<div class="form-group">
									<input type="number" name="tlpnDaf" class="form-control fc-form" placeholder="Telepon" id="tlpnDaf"/>
								</div>

								<div class="form-group">
									<textarea name="alamatDaf" rows="6" class="form-control fc-form" placeholder="Alamat " id="alamatDaf"></textarea>
								</div>


					  
					</div>
					<div class="modal-footer">
						<div class="form-group">
							<button onclick="daftar()" type="button" name="submit" class="btn btn-success" data-dismiss="modal"/>SIMPAN</button>
							<input type="reset" name="reset" class="btn btn-danger" value="ULANG" />
						</div>
					</div>	
						
							</form>
				</div>
			</div>
		</div>
	
<div id="loading-wrap">
	<img src="<?=base_url()?>images/icon/loading-flat.gif" id="wait" alt="Loading" />
</div>	


	  <!-- Modal Sukses -->
  <div class="modal fade" id="myModalSuccess" role="dialog" >
    <div class="modal-dialog" >
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body custom-body">
        	<img align="center" src="<?=base_url()?>images/icon/success.png" class="img-responsive center-block"  width="30%">
        		<h2 align="center">Berhasil</h2>
          		
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




