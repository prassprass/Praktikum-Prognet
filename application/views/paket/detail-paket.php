<body>
<?php
  $title['title'] = 'Paket';
  $this->load->view('header',$title);
?>

<div class="clearfix"></div>
<section>
	<div class="parallax-content" style="background-image: url('<?=base_url()?>/images/M_bg.jpg'); height: 325px;">
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
foreach($data as $data)
?>

<section class="section-padd">
	<div class="container">
	<div class="col-xs-12 bg-popular clear-padding">
		<div class="col-lg-4" style="padding: 30px;">
			<div class="popular-title">
				<h3><?=$data->nama_paket?></h3>
				<h4><?=$data->banyak_hari?> Hari <?=($data->banyak_malam)?$data->banyak_malam:"0"?> Malam</h4>
			</div>

			<div class="popular-item">
				<p><i class="fa fa-map"></i><strong>Destinasi trip :</strong> 
					<ul>
					<?php 
						foreach($data_wisata as $data_wisata){
					?>
						<a href="<?=base_url('DetDestinasi')?>/index/<?=$data_wisata->id_wisata?>"><li class="link-dest"><?=$data_wisata->nama_tempat_wisata?></li></a>
					<?php } ?>
					</ul>
				</p>
				<p><i class="fa fa-map-marker"></i><strong>Hotel :</strong> 
					<ul>
					<?php 
						foreach($data_hotel as $data_hotel){
					?>
						<a href=""><li style="color:#fff"><?=$data_hotel->nama_hotel?></li></a>
					<?php } ?>
					</ul>
				</p>

			</div>

		</div>

		<div class="col-lg-8 clear-padding">
              <div class="flexslider" style="margin:0;">
                  <ul class="slides">
				<?php 
						foreach($data_wisata_foto as $data_wisata_foto){
					?>
						<li><img src="<?=base_url()?>images/top-destination/<?=$data_wisata_foto->foto_wisata?>" class="img-responsive"></li>
					<?php } ?>
                  </ul>
              </div>
            </div>

		</div>
		
			<div class="cd-title" style="padding-top:20px; clear:both;">
				<h3>deskripsi</h3>
				<hr class="hr-style">
			</div>
				<p class="text-center">
					<?=$data->deskripsi_paket?>
				</p>		
	</div>
</section>	

<?php $this->load->view('footer'); ?>

<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.flexslider-min.js"></script>
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
</script>
</body>
</html>