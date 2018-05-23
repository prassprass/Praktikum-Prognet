
<body>
<?php
  $title['title'] = 'Moment';
  $this->load->view('header',$title);
?>

<div class="clearfix"></div>
<section>
	<div class="parallax-content" style="background-image: url('<?=base_url()?>images/M_bg.jpg'); height: 325px;">
		<div class="overlay" style="background:rgba(0, 0, 0, 0.54);">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3">					
						<h3 class="parallax-title">MOMENT</h3>
		          		<p class="parallax-desc">Moment-moment terekan dalam setiap perjalanan kami</p>
		          	</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section style="clear:both;padding: 0; margin-bottom:50px">
    <div class="container">
        <div class="row">
		
			<section class="filter-section" style="padding: 0;">
                <div class="filter-container isotopeFilters2">
                    <ul class="list-inline filter" style="display:none;">
                        <li class="active"><a href="#" data-filter="*">All </a><span>/</span></li>
                        <li><a href="#" data-filter=".foto">Foto</a><span>/</span></li>
                        <li><a href="#" data-filter=".video">Video</a></li>
                    </ul>
                </div>
            </section>
		
            <section class="portfolio-section port-col" ">
                <div class="isotopeContainer2">
				
				<?php 
					  if( !empty($data)){ 
						foreach($data as $data){
            	?>
				
                  <div class="col-md-4 gallery-xs isotopeSelector padd10 foto" style="margin-bottom:10px">
                      <article class="foto">
                          <figure>
                              <img src="<?=base_url()?>images/moment/<?=$data->foto_moment?>" alt="">
                              <div class="overlay-background">
                                  <div class="inner"></div>
                              </div>
                              <div class="overlay">
                                  <div class="inner-overlay">
                                      <div class="inner-overlay-content with-icons" width="80%">
                                          <a title="Tour N Travel Moment" class="fancybox-pop" rel="" href="<?=base_url()?>images/moment/<?=$data->foto_moment?>"><i class="fa fa-search twhite"></i></a>
                                      </div>
                                  </div>
                              </div>
                          </figure>
                          <div class="clearboth"></div>
                      </article>
                  </div>
				  <?php 	}	
						}
					?>
			</div>
		</section>
	</div>
</div>
</section>

<?php $this->load->view('footer'); ?>


<!--file JS-->
<script src="<?=base_url()?>assets/js/isotope.min.js"></script>
<script src="<?=base_url()?>assets/js/jquery.fancybox.pack.js"></script>

<script type="text/javascript">
	$(window).on('load', function() {
        $('#status').fadeOut();
        $('#preloader').delay(120).fadeOut('slow');
    });
</script>
</body>
</html>