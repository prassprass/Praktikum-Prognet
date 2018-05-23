<body>
<?php
  $title['title'] = 'Destinasi';
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
				<h3><?=$data->nama_tempat_wisata?></h3>
				<h4><?=$data->lokasi?></h4>
				<h4 style="color:#fff"><?=$data->jenis_wisata?></h4>
			</div>

			<div class="popular-item">
				<p><i class="fa fa-map"></i><strong>Deskripsi Lokasi :</strong> <br>
					<?=$data->deskripsi_wisata?>
				</p>


			</div>

		</div>

		<div class="col-lg-8 clear-padding">
              <div class="flexslider" style="margin:0;">
                  <ul class="slides">
					<li><img src="<?=base_url()?>images/top-destination/<?=$data->foto_wisata?>" class="img-responsive"></li>
                  </ul>
              </div>
            </div>

		</div>
		
			<div class="cd-title" style="padding-top:20px; clear:both;">
				<h3>Lokasi</h3>
				<hr class="hr-style">
			</div>
            <div class="col-md-12">
                <iframe width="100%" height="500" src="<?=$data->frame_peta?>" frameborder="0" allowfullscreen=""></iframe>
            </div>	
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