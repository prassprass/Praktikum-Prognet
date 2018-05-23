<!DOCTYPE html>
<html>
<head>
<!-- Lime Talk Live Chat start <script type="text/javascript"> var limetalk = (function () { var lc = document.createElement("script"); lc.type = "text/javascript"; lc.async = true; lc.src = "//www.limetalk.com/livechat/58b061827e53c4f717195e33d994e25d"; document.getElementsByTagName("head")[0].appendChild(lc); var fnr = function(fn) { var l = limetalk; if (l.readyList) { l.ready(fn); } else { l.rl = l.rl || []; l.rl.push(fn); } }; fnr.ready = fnr; return fnr; })(); </script> Lime Talk Live Chat end -->


	<title><?=$title?>  | Travel N Tour</title>
	<meta name="viewport" content="width=device-width, initial-scale=0.1">
	
	<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.fancybox.css" type="text/css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/style.min.css" type="text/css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/flexslider.css" type="text/css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/responsive-mobile.css" type="text/css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/owl.carousel.min.css" type="text/css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/owl.theme.default.min.css" type="text/css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url()?>assets/css/datepicker.css" type="text/css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/font-awesome/css/font-awesome.min.css" type="text/css">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	
	
	<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/dashboard-admin/datatables/jquery.dataTables.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/dashboard-admin/datatables/dataTables.bootstrap.min.js"></script>
	<script src="assets/js/jquery.flexslider-min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>assets/js/jquery-ui.js" type="text/javascript"></script>
	
			
	
</head>
<div id="preloader">
	<div id="status"></div>
</div>
<div class="container">
	<div class="row">
	<div class="header-top">
		<div class="container clear-padding" style="border-bottom: 1px solid #ddd">
			<div class="navbar-contact">
				<div class="col-md-4 clear-padding mr-1">
					<p>Kontak Kami : <i class="fa fa-phone"></i>&nbsp;&nbsp;+6283213144</p>
				</div>

				<div class="col-md-8 col-xs-12 clear-padding mr-1">
					
						
						<?php
							if($this->session->userdata('status_user') != "login"){
						?>	
						<div class="icon-sosmed">
							<ul>
									<li><a href="<?=base_url('User')?>">MASUK</a></li>
									<li><a style="border-right:1px inset #888686"href="<?=base_url('User')?>"></a></li>
									<li><a href="<?=base_url('User')?>">DAFTAR </a></li>
							</ul>
						</div>							
						<?php	
							}else{
						?>
								<ul class="nav navbar-right top-nav">
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#888686">
											<span style="font-size:14px"><b>Hallo <?=$this->session->userdata('user')?></b></span>
											<span class="caret"></span>
										</a>
										<ul class="dropdown-menu" role="menu">
											<li><a href="<?=base_url("User/profil/")?><?=$this->session->userdata('id_user')?>"><i class="fa fa-map"></i> Trip</a></li>
											<li class="divider"></li>
											<li><a href="<?=base_url('User/logout'); ?>"><i class="fa fa-fw fa-power-off"></i> Logout</a></li>
										</ul>
									</li>
								</ul>
						<?php } ?>	

							<!--
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
							!-->

				</div>
			</div>
		</div>
	</div>
	</div>
</div>

<div class="clearfix"></div>
<div class="light-menu">
	<div class="col-lg-12 clear-padding">
		<nav class="navbar navbar-default affix" data-spy="affix" data-offset-top="40" role="navigation">
			<div class="container clear-padding">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="<?=base_url()?>" class="navbar-brand">Tour & Travels</a>
			</div>

			<div class="collapse navbar-collapse clear-padding" id="navigation">
				<ul class="nav navbar-nav navbar-right">
					<li <?php if($title=="Beranda")echo "class='active'";?>><a href="<?=base_url()?>">BERANDA</a></li>
					<li <?php if($title=="Paket")echo "class='active'";?>><a href="<?=base_url('Paket')?>">PAKET</a></li>
					<li <?php if($title=="Destinasi")echo "class='active'";?>><a href="<?=base_url('Destinasi')?>">DESTINASI</a></li>
					<li <?php if($title=="Pembayaran")echo "class='active'";?>><a href="<?=base_url('Pembayaran')?>">PEMBAYARAN</a></li>
					<li <?php if($title=="Moment")echo "class='active'";?>><a href="<?=base_url('Moment')?>">MOMENT</a></li>
					<li <?php if($title=="Tentang")echo "class='active'";?>><a href="<?=base_url('Tentang')?>">TENTANG KAMI</a></li>
					<li <?php if($title=="Kontak")echo "class='active'";?>><a href="<?=base_url('Kontak')?>">KONTAK</a></li>
					<a href="<?=base_url('Booking')?>"><button type="button" class="btn-bn">BOOK NOW</button></a>
				</ul>
			</div>
			</div>
		</nav>
	</div>
</div>