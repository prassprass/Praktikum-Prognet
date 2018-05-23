<?php
$title['title'] = 'Dashboard';
$this->load->view('header-admin',$title);
?>

		
		<section class="content">
		<div style="font-size:100px; text-align:center; margin:50px; font-family: Pacifico;">Tour & Travel</div>
			<div class="box">
				<div class="box-header">
					<h2><b>Trip Berikutnya </b><small>Overview</small></h2>
				</div>	
					<div class="row">	
						 <div class="box-body">
						 <div class="col-md-6">
							<?php 
							  if( !empty($data)){ 
								foreach($data as $data){
							?>
								<div class="col-md-12 book">
									<b style="font-size:20px">Trip <?=$data->tgl_traveling?></b><br>
									Paket <b><?=$data->nama_paket?></b> - <?=$data->banyak_traveler?> Orang<br>
									Oleh : <?=$data->nama_user?><br>
								</div>	 
								<?php		
								}
							}
							?>
						</div>	 
						</div>
					</div>
			</div>
				
			
			</div>
		</section>
	
</div>
</div>
</body>
</html>
