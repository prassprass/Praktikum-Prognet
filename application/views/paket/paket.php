<body>
<?php
  $title['title'] = 'Paket';
  $this->load->view('header',$title);
?>

<div class="clearfix"></div>
<section>
	<div class="parallax-content" style="background-image: url('<?=base_url()?>images/M_bg.jpg'); height: 325px;">
		<div class="overlay" style="background:rgba(0, 0, 0, 0.54);">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3">					
						<h3 class="parallax-title">paket trip</h3>
		          		<p class="parallax-desc">temukan trip mu dan ciptakan keseruan mu</p>
		          	</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php 
	if( !empty($data)){ 
?>
<section class="section-padd">
	<div class="container">
	
        <?php 
      		foreach($data as $data){
        ?>
		
		<div class="col-sm-4">
			<div class="lbl-price">
				IDR. <?=$data->harga_paket?> / Pack
			</div>
			<img src="<?=base_url()?>images/package/<?=$data->foto_paket?>" class="img-responsive">
				
			<div class="desc-tp">
				<h4 style="text-transform: uppercase;"><?=$data->nama_paket?></h4><h4><?=$data->banyak_hari?> Hari, <?=($data->banyak_malam)?$data->banyak_malam:"0"?> Malam</h4>
				<p>
					<?php if(strlen($data->deskripsi_paket)<80) echo $data->deskripsi_paket."<br><br>"; 
							else echo substr($data->deskripsi_paket, 0, 80)."...";?>
				</p>
				
				<a href="<?=base_url('DetPaket')?>/index/<?=$data->id_paket?>">Lihat selengkapnya <i class="fa fa-angle-double-right"></i></a>
			</div>
		</div>
		<?php 
			}
		?>

	</div>
</section>	
<?php if (isset($links)) {
		echo $links;
	} 
?>
			
		<?php } else  { ?>
				<b><h3 style='opacity:0.5; text-align:center; margin-top:50px'>TIDAK ADA PAKET YANG SESUAI</h3></b> <br>
				<a href="<?=base_url()?>"><b><h4 style='opacity:0.8; text-align:center;'>telusuri lagi...</h4></b></a>
		<?php } ?>


<section class="section-padd" style="padding-bottom:0;">
	<div class="parallax-content" style="height: 360px;">
		<div class="overlay clr" style="background: #eee;">
			<h3>dapatkan diskon <r>20-30%</r> dari semua paket kami</h3>

			<p>pesan sekarang dan buat trip yang tak terlupakan dengan harga spesial</p>

			<div class="parallax-btn">
				<a href="form-booking.html">pesan sekarang</a>
			</div>
		</div>
	</div>
</section>


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