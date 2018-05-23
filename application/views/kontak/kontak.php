
<body>
<?php
  $title['title'] = 'Kontak';
  $this->load->view('header',$title);
?>


<div class="clearfix"></div>
<section>
	<div class="parallax-content" style="background-image: url('<?=base_url()?>images/M_bg.jpg'); height: 325px;">
		<div class="overlay" style="background:rgba(0, 0, 0, 0.54)";>
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3">
						<h3 class="parallax-title">Kontak</h3>
		          		<p class="parallax-desc">kontak kami</p>
		          	</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="section-padd" style="padding-top: 100px;">
	<div class="container">
		<div class="col-md-4 custom-ct">
			<div class="icon-title">
				<i class="fa fa-map-marker"></i>
			</div>

			<h3>Alamat Kantor</h3>
			<p>Street Ratih Number #11, Sedang Village, Abiansemal Badung</p>
		</div>

		<div class="col-md-4 custom-ct">
			<div class="icon-title">
				<i class="fa fa-phone"></i>
			</div>

			<h3>Layanan Pelanggan</h3>
			<p>007 312 124848</br>
				(0361) 460224</p>
		</div>

		<div class="col-md-4 custom-ct">
			<div class="icon-title">
				<i class="fa fa-envelope-o"></i>
			</div>

			<h3>Email</h3>
			<p>tourntravel@service.com</p>
		</div>	
	</div>
</section>

<section class="section-padd">
	<div class="maps-canvas">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2345.8593103324038!2d115.23416152569423!3d-8.572004418048111!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23e80b85a7f31%3A0xb1d2e54f4e4fd228!2sJl.+Ratih+No.11%2C+Sedang%2C+Abiansemal%2C+Kabupaten+Badung%2C+Bali+80352!5e0!3m2!1sen!2sid!4v1516884651867" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
	</div>
</section>

<section class="section-padd">
	<div class="container">
		<div class="info-ct">
			<h3>Kritik & Saran</h3>
			<p><i class="fa fa-2x fa-angle-down"></i></p>
			<p>Tulisankan pertanyaan, komentar, kritik, dan saran mu</p>
			<p>tim kami akan mencoba mejawab dengan mengirmkan mu email. trimakasi</p>
		</div>

		<div class="col-lg-8 col-lg-offset-2">
			<form action="#" method="post">
				<div class="form-group col-md-6 clear-padding">
					<input type="text" class="form-control form-style" placeholder="Nama*">
				</div>
				<div class="form-group col-md-6 clear-padding">
					<input type="text" class="form-control form-style" placeholder="Alamat Email*">
				</div>
				<div class="form-group">
					<textarea type="text" class="form-control style-msg" rows="6" placeholder="Pesan*"></textarea>
				</div>
				<button type="submit" class="btn-send">KIRIM PESAN</button>
			</form>
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