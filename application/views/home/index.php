
<body>
<?php
  $title['title'] = 'Beranda';
  $this->load->view('file_js');
  $this->load->view('header',$title);
?>

<div class="clearfix"></div>
<div class="banner">
<div id="carousel-banner" class="carousel slide" data-ride="carousel">
    <!-- Carousel Indicator -->
    <!--<ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    </ol>-->

    <!-- Wrapper for slider -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="<?=base_url()?>images/resize/dd.jpg" alt="Slide 1" class="img-responsive" style="width:100%">
            <div class="carousel-caption">
                <h2>Tempat Tempat Terpopuler</h2>
                <h4>bersama kami <br>buat kenangan tak terlupakan</h4>
                <a href="<?=base_url('Destinasi')?>" style="display:none;">LIHAT SELENGKAPNYA</a>
            </div>
        </div>
        <div class="item">
            <img src="<?=base_url()?>images/resize/aa.jpg" alt="Slide 2" class="img-responsive" style="width:100%">
            <div class="carousel-caption">
                <h2>Tempat Tempat Terpopuler</h2>
                <h4>bersama kami <br>buat kenangan tak terlupakan</h4>
            </div>
        </div>
      </div>

    <!-- Controls -->
    <a href="#carousel-banner" class="carousel-control left" data-slide="prev" role="button">
        <span class="fa fa-chevron-left"></span>
    </a>
    <a href="#carousel-banner" class="carousel-control right" data-slide="next" role="button">
        <span class="fa fa-chevron-right"></span>
    </a>
</div>
</div>


<div class="col-lg-8 col-lg-offset-2 clear-padding tours-src">
	<div class="panel panel-default">
		<div class="panel-heading">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab1" data-toggle="tab">TEMUKAN TRIP MU</a></li>
				<li><a href="#tab2" data-toggle="tab">TELUSURI WISATA&nbsp;&nbsp;<i class="fa fa-angle-down"></i></a></li>
			</ul>
		</div>

		
		<div class="panel-body">
		<div class="tab-content">
		
		
			<div class="col-lg-12 clear-padding tab-pane fade in active" id="tab1">
			  <?php echo form_open_multipart("Paket/index"); ?> 
				<!--<div class="col-xs-4 mr-src-panel">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
						<input type="text" class="form-control custom-form" placeholder="Lokasi">
					</div>
				</div>

				<div class="col-xs-4 mr-src-panel" style="display:none;">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						<input type="text" class="form-control custom-form" id="date1" placeholder="Starting From">
					</div>
				</div>!-->

				<div class="col-xs-6 mr-src-panel">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-hourglass-start"></i></span>
						<select name="hari" class="form-control custom-form">
							<option value="">Banyak Hari</option>
							<option value="1">1 Hari</option>
							<option value="2">2 Hari</option>
							<option value="3">3 Hari</option>
							<option value="4">4 Hari</option>
							<option value="5">5 Hari</option>
							<option value="6">6 Hari</option>
							<option value="7">7 Hari</option>
						</select>
					</div>
				</div>

				<div class="col-xs-6 mr-src-panel">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-money"></i></span>
						<select name="harga" class="form-control custom-form">
							<option value="">Budget</option>
							<option value="1000000">dibawah IDR.1000 K / pack</option>
							<option value="2000000">dibawah IDR.2000 K / pack</option>
							<option value="5000000">dibawah IDR.5000 K / pack</option>
							<option value="10000000">dibawah IDR.10000 K / pack</option>
							<option value="15000000">dibawah IDR.15000 K / pack</option>
						</select>			
					</div>
				</div>

				<div class="col-lg-12 clear-padding" style="margin-top: 20px;">
					<div class="col-xs-3 col-xs-offset-9 button-find">
						<input type="submit" value="CARI" class="btn-bn" style="width:100%" name="cari">
					</div>
				</div>
			  <?php echo form_close();?>	
			</div>
			

				<div class="col-lg-12 clear-padding tab-pane fade" id="tab2">
				 <?php echo form_open_multipart("Destinasi/index"); ?> 
					<div class="col-xs-6 mr-src-panel">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
						<input type="text" name="lokasi" class="form-control custom-form" placeholder="Lokasi">
					</div>
				</div>

				<div class="col-xs-6 mr-src-panel">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
						<select name="jenis" class="form-control custom-form">
							<option value="0">Jenis Wisata</option>
							<?php 
								if( !empty($data_jenis_wisata)){ 
								foreach($data_jenis_wisata as $data_jenis_wisata){
							?>
							<option value="<?=$data_jenis_wisata->id_jenis_wisata?>"><?=$data_jenis_wisata->jenis_wisata?></option>
							<?php } } ?>
						</select>			
					</div>
				</div>

					<div class="col-lg-12 clear-padding" style="margin-top: 20px;">
						<div class="col-xs-3 col-xs-offset-9 button-find">
							<input type="submit" value="CARI" class="btn-bn" style="width:100%" name="cari">
						</div>
					</div>
				 <?php echo form_close();?>
				</div>
			</div>
		</div>
	</div>
</div>


<!--Section Top 1-->
<section class="section-padd margin-bot">
	<div class="container">
		<div class="col-md-4">
			<div class="item-triped">
				<img src="<?=base_url()?>images/icon/1.png" class="img-responsive" />
				<h4>DESTINATION</h4>
				<p>We have recomendations of attractions</p>
			</div>
		</div>

		<div class="col-md-4">
			<div class="item-triped">
				<img src="<?=base_url()?>images/icon/2.png" class="img-responsive" />
				<h4>TOP PLACE</h4>
				<p>We provide travel information media</p>
			</div>
		</div>

		<div class="col-md-4">
			<div class="item-triped">
				<img src="<?=base_url()?>images/icon/3.png" class="img-responsive" />
				<h4>BOOK NOW</h4>
				<p>Safe and reliable booking</p>
			</div>
		</div>
	</div>
	<hr class="hr-custom">	
</section>



<div class="cd-title">
	<h3>MOMENT BARU TERCIPTA</h3>
	<hr class="hr-style">
</div>
		
<section class="section-padd">
	<div class="container">
		<div id="owl-moment" class="owl-carousel owl-theme">
		
		 <?php 
			if( !empty($data_moment)){ 
      		foreach($data_moment as $data_moment){
        ?>
		
		<div style="width: 100%;">
			<div class="col-sm-6">
				<img src="<?=base_url()?>images/moment/<?=$data_moment->foto_moment?>" class="img-responsive" />
			</div>

				<div class="col-sm-6">
					<div class="desc-popular">
						<h3><?=$data_moment->judul_moment?></h3>
						<h5><?=$data_moment->lokasi_moment?>, <?=$data_moment->tanggal_moment?></h5>

						<p><?=$data_moment->deskripsi_moment?></p>

						<div class="btn-ctn6">
							<a href="<?=base_url('Moment')?>">LIHAT LEBIH BANYAK</a>
						</div>
					</div>
				</div>
			</div>
		<?php 	}
			}
		?>
		
		</div>
	</div>
</section>

<section class="section-padd">
	<div class="parallax-content" style="background-image: url('<?=base_url()?>images/M_bg.jpg'); height: 360px;">
		<div class="overlay">
			<h3>dapatkan diskon <r>20-30%</r> dari semua paket kami</h3>

			<p>pesan sekarang dan buat trip yang tak terlupakan dengan harga spesial</p>

			<div class="parallax-btn">
				<a href="<?=base_url('Booking')?>">Rencanakan Petualangan mu</a>
			</div>
		</div>
	</div>
</section>


<div class="cd-title" style="padding-top:50px;">
	<h3>DESTINASI WISATA POPULER</h3>
	<hr class="hr-style">
</div>

<section class="section-padd" style="padding-bottom:50px;">
	<div class="container">
		
		<div id="owl-dest" class="owl-carousel owl-theme">

	    <?php 
			if( !empty($data_wisata)){ 
      		foreach($data_wisata as $data_wisata){
        ?>
		
		<div style="width: 100%;">
			<div class="col-sm-6">
				<div class="desc-popular">
					<h3><?=$data_wisata->nama_tempat_wisata?></h3>
					<h5><r><?=$data_wisata->jenis_wisata?></r> - <?=$data_wisata->lokasi?></h5>

					<p><?=$data_wisata->deskripsi_wisata?></p>


					<div class="btn-ctn6">
						<a href="<?=base_url('Destinasi')?>">Detail Destinasi</a>
					</div>
				</div>
			</div>

			<div class="col-sm-6">
				<img src="<?=base_url()?>images/top-destination/<?=$data_wisata->foto_wisata?>" class="img-responsive" />
			</div>
		</div>
		<?php
				}
			}
		?>
		
		</div>
		
	</div>
</section>

<section class="section-padd" style="padding-bottom: 0;">
	<div class="parallax-content" style="background-image: url('<?=base_url()?>images/forest.jpg');">
	<div class="package-overlay">
	<div class="container">
		<div class="packages-title">
			<h3>paket terpopuler</h3>
			<p></p>
		</div>
			<!--Package-->
			<div class="detail-package owl-carousel owl-theme" >
			
				<?php 
					if( !empty($data_paket)){ 
						foreach($data_paket as $data_paket){
				?>
				<div class="owls-item col-md-4">
					<div class="lbl-price">
						IDR. <?=$data_paket->harga_paket?>
					</div>
					<img src="<?=base_url()?>images/package/<?=$data_paket->foto_paket?>" class="img-responsive" />

					<h4><?=$data_paket->nama_paket?> - <?=$data_paket->banyak_hari?> Hari, <?=$data_paket->banyak_malam?> Malam</h4>
					<p>
						<?php if(strlen($data_paket->deskripsi_paket)<80) echo $data->deskripsi_paket."<br><br>"; 
								else echo substr($data_paket->deskripsi_paket, 0, 80)."...";?>
					</p>

					<a href="<?=base_url('DetPaket')?>/index/<?=$data_paket->id_paket?>">read more <i class="fa fa-arrow-circle-right"></i></a>
				</div>
				<?php
						}
					}
				?>
			</div>

			<div class="btn-package">
				<a href="<?=base_url('Paket')?>">paket lainnya</a>
			</div>
		</div>
	</div>
	</div>
</section>


<?php $this->load->view('footer'); ?>


<!--file JS-->
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#owl2").owlCarousel({
			interval:2000,
			dots:false
		});
		
		$("#owl-dest").owlCarousel({
			items:1,
			autoplay:true,
			nav:false
		});

		$("#owl-moment").owlCarousel({
			items:1,
			autoplay:true,
			nav:false
		});

		$("#date1").datepicker();
	});

	$(window).on('load', function() {
        $('#status').fadeOut();
        $('#preloader').delay(120).fadeOut('slow');
    })
</script>
</body>
</html>