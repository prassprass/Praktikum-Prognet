<body>
<?php
  $title['title'] = 'Booking';
  $this->load->view('header',$title);
?>
<!--file JS-->

<script type="text/javascript" src="<?=base_url()?>assets/plugins/sweetalert-master/dist/sweetalert.min.js" ></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/stepwizard.js" ></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery-ui.js" ></script>

<script type="text/javascript">

			 function harga(){
				var bpackage = [];
					$.each($("input[name='check1']:checked"), function(){            
					bpackage.push($(this).val());
				});
			  $.ajax({
				 type: "GET", 
				 url: "<?php echo base_url(); ?>"+"booking/load_harga_paket/"+bpackage,
				 dataType : "json", 
				 success: function(data) {
					
					$("#harga").val(data[0].harga_paket);
					}
				 
				});
			 }    

			 
            $(document).ready(function(){
                
                $('#wait').hide();
                $('#loading-wrap').hide();

        		$('#tombol').click(function() { //onclick untuk melakukan CRUD ajax
                    
					var id_user = $('#id_user').val();
					var nama = $('#bookName').val();
					var email = $('#email').val();
					var date = $('#tanggal').val();
					var phone = $('#tlpn').val();
					var msg = $('#msg').val();
					var total_harga = $('#grandTotalPk').val();
					var pack = $('#bookAdult').val();
					
					var bpackage = [];
					$.each($("input[name='check1']:checked"), function(){            
						bpackage.push($(this).val());
					});
					
					if(pack==0){
						alert("Masukan Banyak Pack !");
					}else{
				
					  $('#wait').show();
					  $('#loading-wrap').show();
					
						$.ajax({
							 type: 'POST',
							 url: "<?php echo base_url(); ?>"+"Booking/booking", 
							 data: 'id_user=' + id_user + '&email=' + email + '&tanggal=' + date + '&tlpn=' + phone + '&msg=' + msg + '&pk=' + bpackage + '&total_harga=' + total_harga + '&pack=' + pack,
							 success: function(msg) {
									if(msg=="success"){
									  $("#myModalSuccess").modal();
									  $('#wait').hide();
									  $('#loading-wrap').hide();									  

									}else{
									  $("#myModalFail").modal();
									  $('#wait').hide();
									  $('#loading-wrap').hide();									  
									}	
								}
							})
						}
					});
				})


			$(document).ready(function() {


				function subCalPrice() { //function untuk menghitung otomatis harga nantinya
					//var sumSubPrice;
					//var sumPriceAdult;
					//var sumPriceChild;
					
					var harga = $('#harga').val();
					var bookAdult = $('#bookAdult').val();


				
					total = (bookAdult * harga)//hitung untuk ditaruh di field Grand Total

					$('#grandTotalPk').val(total);
				}

				$('#bookAdult').change(function() {
					subCalPrice();
				});

			});
		</script>


<div class="clearfix"></div>
<section>
	<div class="parallax-content" style="background-image: url('<?=base_url()?>images/M_bg.jpg'); height: 325px;">
		<div class="overlay" style="background:rgba(0, 0, 0, 0.54);">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3">					
						<h3 class="parallax-title">Booking</h3>
		          		<p class="parallax-desc">Tentukan dan Booking perjalanan mu disini</p>
		          	</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section-padd">
	
<div class="container">
	<!-- Step Wizard -->
	<div class="col-sm-12">
	<div class="stepwizard">
		<div class="stepwizard-row setup-panel">
			<div class="stepwizard-step col-md-4">
				<a href="#step-1" type="button" class="btn btn-danger btn-circle" >1</a>
				<p align="center">Step 1</p>
			</div>
			<div class="stepwizard-step col-md-4">
				<a href="#step-2" type="button" class="btn btn-default btn-circle"  disabled="disabled">2</a>
				<p align="center">Step 2</p>
			</div>
			<div class="stepwizard-step col-md-4">
				<a href="#step-3" type="button" class="btn btn-default btn-circle"  disabled="disabled">3</a>
				<p align="center">Step 3</p>
			</div>
		</div>
	</div>
	</div>

	<script type="text/javascript">
		function validateForm(){ 
			var bpackage = [];
					$.each($("input[name='check1']:checked"), function(){            
					bpackage.push($(this).val());
			});

			/*if(
				$('#harga').val()==="",
				$('#name').val()==="",
				$('#email').val()==="",
				$('#tanggal').val()==="",
				$('#tlpn').val()==="")
				{
					alert("Warning! Please fill all required feild!");
					return false;
				}*/
			function isEmpty(bpackage){
					alert("Warning! Please fill all required feild!");
					return false;
			}				
		return true;
		}
	</script>
	<!-- Form -->
	<form action="" name="frm" id="frm" method="post" role="form" style="margin-bottom:20px;">
		
		<input type="hidden" name="id_user" id="id_user" value="<?=$this->session->userdata('id_user')?>"/>
	
		<!-- Step 1 -->
		
				<div class="setup-content" id="step-1">
			<div class="col-sm-12">
				<h1>STEP 1</h1>
				<p>Klik nama Paket untuk memilih paket</p>
			</div>


			<section class="section-padd">
				<div class="container">
				
					<?php 
						if( !empty($data)){ 
						foreach($data as $data){
					?>
	
								<div class='col-md-4 pull-width' style="margin-top:30px">
									<div class="lbl-price" style="position:relative">
										IDR. <?=$data->harga_paket?> / Pack <br> <?=$data->banyak_hari?> Hari, <?=($data->banyak_malam)?$data->banyak_malam:"0"?> Malam	
									</div>
									<img src='<?=base_url()?>/images/package/<?=$data->foto_paket?>' class="img-responsive img-check" style="opacity:0.4"/>
									<button type="button" class="btn btn-danger btn-check" style="width:100%; text-transform: uppercase;"><h4><b><?=$data->nama_paket?></b></h4></button>
									<input type="checkbox" id="check1" name="check1" class="myCheckbox hidden" value="<?=$data->id_paket?>" required>
								</div>

					
					<?php		
							}
						}
					?>
					
				</div>
			</section>	
			<?php if (isset($links)) {
					echo $links;
				} 	
			?>
			
			<script type="text/javascript">
				$(document).ready(function() {
					$('.myCheckbox').click(function() {
						$(this).siblings('input:checkbox').prop('checked', false)
					});
				});
			
				$(function(){
					$('.btn-check').click(function(e){
						$('.btn-check').not(this).removeClass('active')
							.siblings('input').prop('checked',false)
							.siblings('.img-check').css('opacity','0.4')

						$(this).addClass('active')
							.siblings('input').prop('checked',true)
							.siblings('.img-check').css('opacity','1')
							harga();

					});
				});
				
				
			</script>
			<div class="col-xs-12" style="margin:20px 0 10px;">
				<button type="button" class="btn btn-prev prevBtn pull-left"><i class="fa fa-angle-double-left"></i> Prev</button>
				<button type="button" class="btn btn-next nextBtn pull-right" onclick="return validateForm()">Next <i class="fa fa-angle-double-right"></i></button>
			</div>
		</div>
		
		

		<!-- Step 2 -->

		<div class="setup-content" id="step-2">
			<div class="col-xs-12"><h1>STEP 2</h1></div>
			<div class="col-md-4 screen78">
				<div class="form-group">
					<label class="control-label">Nama Pembooking</label>
					<input type="text" name="name" id="bookName" class="form-control" placeholder="Your Name" required="required" readonly value="<?=$this->session->userdata('user')?>"/>
				</div>
				<div class="form-group">
					<label class="control-label">Email</label>
					<input type="email" name="email" id="email" class="form-control" placeholder="Your Email" readonly value="<?=$this->session->userdata('email')?>"/>
				</div>
			</div>

			<div class="col-md-4 screen78">
				<div class="form-group">
					<label class="control-label">Tanggal Travelling</label>
					<input type="text" name="tanggal" id="tanggal" class="form-control" placeholder="Date" required="required" />
				</div>
				<div class="form-group">
					<label class="control-label">Telepon</label>
					<input type="text" name="tlpn" id="tlpn" class="form-control" placeholder="Your Phone"  readonly value="<?=$this->session->userdata('tlpn')?>"/>
				</div>
			</div>
			<div class="col-md-4 screen77" style="margin-bottom:20px;">
				<div class="form-group">
					<label>Permintaan Spesial</label>
					<textarea type="text" name="msg" id="msg" rows="5" class="form-control" placeholder="Note..."></textarea>
				</div>
				<button	type="button" onclick="return validateForm()" class="btn btn-next nextBtn pull-right">Next <i class="fa fa-angle-double-right"></i></button>
			</div>
		</div>

		<!-- Step 3 -->
		<div class="setup-content" id="step-3">
			<div class="col-sm-12"><h1>STEP 3</h1></div>
					
			<div class="col-md-4 screen78">
				<div class="form-group">
					<label class="control-label">Banyak Orang</label>
					<input type="number" id="bookAdult" name="banyak_orang" class="form-control" value="0" required />
				</div>
			</div>

			<div class="col-md-4 screen78">
				<div class="form-group">
					<label class="control-label">Harga Per Pack</label>
					<input type="text" id="harga" name="harga" class="form-control size_control" readonly>
				</div>
			</div>
			
			<div class="col-md-4 screen77">
				<div class="form-group">
					<label class="control-label">Total Harga</label>
					<input type="number" id="grandTotalPk" class="form-control size_control" readonly style="font-size:50px; height:70px;" value="0">
				</div>
			</div>
		
				<div class="form-group">
					<button type="submit" id="tombol" class="btn btn-warning btn-book pull-right" style="width:100%;font-size:30px;">BOOK NOW</button>	
				</div>
		
			<div class="col-md-12" style="margin-bottom:20px;">
				<button type="button" class="btn btn-prev prevBtn pull-left"><i class="fa fa-angle-double-left"></i> Prev</button>
			</div>
		</div>
	</form>
</div>



</section>	


<div id="loading-wrap">
	<img src="images/icon/loading-flat.gif" id="wait" alt="Loading" />
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
 

<?php $this->load->view('footer'); ?>



<script type="text/javascript">

	$(document).ready(function() {
		$("#tanggal").datepicker({
			dateFormat			: "yy-mm-dd",
			minDate				: 5,
			showOtherMonths		: true,
      		selectOtherMonths	: true
		});
	});
	
	$(window).on('load', function() {
        $('#status').fadeOut();
        $('#preloader').delay(120).fadeOut('slow');
    });
</script>
</body>
</html>