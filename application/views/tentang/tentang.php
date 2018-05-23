
<body>
<?php
  $title['title'] = 'Tentang';
  $this->load->view('header',$title);
?>

<div class="clearfix"></div>
<section>
	<div class="parallax-content" style="background-image: url('<?=base_url()?>images/M_bg.jpg'); height: 325px;">
		<div class="overlay" style="background:rgba(0, 0, 0, 0.54)";>
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3">
						<h3 class="parallax-title">Tentang Tour N Travels</h3>
		          		<p class="parallax-desc">kenali tim kami sebagai rekan traveling anda</p>
		          	</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section-padd">
	<div class="container">
		<div class="col-lg-12 text-center">
			<div class="company-title">
				<h2>bagaimana kami <r>Berdiri</r></h2>
			</div>

			<div class="company-desc">
				<p>Since 2017, the company is referred to as a travel consultant company. This company has a duty as a container in providing job opportunities with consultation and selection of information that suits the needs of consumers. We also provide suggestion options, including building relationships with customers to be able to know their needs and desires. from this web I provide a glimpse of how the travel company works by providing a safe and good service.</p>
			</div>
		</div>
	</div>
</section>

<section class="section-padd xs2" style="padding-top: 12em;">
	<div class="company-wrapper" style="">
		<img src="<?=base_url()?>images/profile.jpg" class="company-img">
	</div>
	<div class="parallax-content" style="background-image: url('<?=base_url()?>images/profile.jpg'); height:340px;">
		<div class="overlay company-list" style="background: rgba(0, 0, 0, 0.8.8);">
			<div class="container company-cover">
				<div class="col-xs-3 xs1">
					<h3>6</h3>
					<p>Anggota Tim</p>
				</div>

				<div class="col-xs-3 xs1">
					<h3>100</h3>
					<p>Petulangan tercipta</p>
				</div>

				<div class="col-xs-3 xs1">
					<h3>10</h3>
					<p>Paket Trip Menarik</p>
				</div>

				<div class="col-xs-3 xs1">
					<h3>2018</h3>
					<p>Tahun Dimulai</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section-padd">
	<div class="container">
		<div class="owl-carousel owl-theme" id="owl-about">
			<div class="owls-item">
				<div class="about-testi">
					<img src="<?=base_url()?>images/petik.png">
					<p>For my part, I travel not to go anywhere, but to go. I travel for travel’s sake. The great affair is to move.</strong></p>

					<h3>Robert Louis Stevenson</h3>
					<h5>Traveller</h5>
				</div>
			</div>

			<div class="owls-item">
				<div class="about-testi">
					<img src="<?=base_url()?>images/petik.png">
					<p>We travel, some of us forever, to seek other places, other lives, other souls.</p>

					<h3>Anais Nin</h3>
					<h5>Traveller</h5>
				</div>
			</div>

			<div class="owls-item">
				<div class="about-testi">
					<img src="<?=base_url()?>images/petik.png">
					<p>The gladdest moment in human life, me thinks, is a departure into unknown lands.</p>

					<h3>Sir Richard Burton</h3>
					<h5>Traveller</h5>
				</div>
			</div>
		</div>
	</div>
</section>

<?php $this->load->view('footer'); ?>

<!--file JS-->
<script type="text/javascript" src="<?=base_url()?>assets/js/owl.carousel.min.js"></script>
<script type="text/javascript">
	$(window).on('load', function() {
        $('#status').fadeOut();
        $('#preloader').delay(120).fadeOut('slow');
    })

    $(window).load(function(){
    	$('.flexslider').flexslider({
    		animation: "fade"
    	});
    });

    $(document).ready(function() {
		$("#owl-about").owlCarousel({
			autoplay:false,
			dots:true,
			items:1
		});
	});
</script>
</body>
</html>