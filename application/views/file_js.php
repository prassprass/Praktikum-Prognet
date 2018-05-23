<!--JQuery-->
<script src="<?=base_url()?>assets/js/jquery.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/js/jquery-ui.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/js/jquery.flexslider-min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(window).load(function() {
          $('.flexslider').flexslider({
              animation: "fade",
              animationSpeed: 600,
              slideshowSpeed: 8000,
              directionNav:true,
          });
    });

    $(document).ready(function(){
        $('#myslider').carousel({
            interval : 8000
        })
    });
</script>
