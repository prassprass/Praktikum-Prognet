
<body>
<?php
  $title['title'] = 'Destinasi';
  $this->load->view('header',$title);
 
 ?>


<div class="clearfix"></div>
<section>
	<div class="parallax-content" style="background-image: url('<?=base_url()?>images/M_bg.jpg'); height: 325px;">
		<div class="overlay" style="background:rgba(0, 0, 0, 0.54)";>
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3">
						<h3 class="parallax-title">Destinasi</h3>
		          		<p class="parallax-desc">ketahui lebih banyak tentang tujuan perjalanan mu</p>
		          	</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section-padd" style="padding-bottom: 0;">
	<div class="container">
		<div class="cd-title">
			<h3>destinasi trip</h3>
			<hr class="hr-style">
		</div>

		<p class="text-center">There are several attractions that are classified as popular places that are often visited.<br> Here are some places - places that attract tourists with a variety of spectacular views, <br>and you can capture a moment of rare and beautiful moments.</p>
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
	
		<div class="col-md-4" style="margin:30px 0 0px 0;">
		<div class="contain">
			<img src="<?=base_url()?>images/top-destination/<?=$data->foto_wisata?>" class="img-responsive">
			<div class="cars-overlay">
				<div class="border1">
					<div class="cars-desc">
						<h3><?=$data->nama_tempat_wisata?></h3>
						<hr class="new-hr">

					</div>
				</div>	
			</div>
		</div>
		
		<div class="desc-3tp">
			<h3><?=$data->nama_tempat_wisata?></h3>
			<p><?=$data->lokasi?></p>
			<a href="<?=base_url("DetDestinasi")?>/index/<?=$data->id_wisata?>">Lihat selengkapnya <i class="fa fa-angle-double-right"></i></a>		
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
				<b><h3 style='opacity:0.5; text-align:center; margin-top:50px'>TIDAK ADA WISATA YANG SESUAI</h3></b> <br>
				<a href="<?=base_url()?>"><b><h4 style='opacity:0.8; text-align:center;'>telusuri lagi...</h4></b></a>
		<?php } ?>


<?php $this->load->view('footer'); ?>

<!--file JS-->
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