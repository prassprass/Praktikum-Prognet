<?php
$title['title'] = 'Laporan';
$this->load->view('header-admin',$title);
?>

<script>
$(document).ready(function(){
 $('#wait').hide();
 $('#loading-wrap').hide();
 
  });
  
  function reload(){

  $.ajax({
     type: "GET", 
     url: "<?php echo base_url(); ?>"+"Momentdata/load_data",
	 dataType : "json", 
     success: function(data) {
     var i = 0;
		$("#dataMoment").empty()
		while (i < data.data.length) {
	 
		 	$("#dataMoment").append('<tr><td>'+(i+1)+'</td>'
			 +'<td>'+data.data[i].judul_moment+'</td>'
			 +'<td>'+data.data[i].lokasi_moment+'</td>'
			 +'<td>'+data.data[i].tanggal_moment+'</td>'
			 +'<td>'+data.data[i].deskripsi_moment+'</td>'
			 +'<td><img src="<?=base_url()?>images/moment/'+data.data[i].foto_moment+'" width="230px" height="200px"></td>'
			 +'<td><button type="button" onclick="edit_data('+data.data[i].id_moment+')" name="edit" class="btn btn-primary"><i class="fa fa-edit" title="Edit"></i></button></td></tr>');
				i+=1;
             }
			$('#wait').hide();
			$('#loading-wrap').hide(); 
			$("#myModalSuccess").hide();
          }

       });

 }
   	

</script>



<div class="page-wrapper">
        <div class="page-header">
            <h3>Data Wisata <small>Data Wisata</small></h3>
		</div>

        <ul class="breadcrumb">
            <li><a href='<?php echo base_url("Bookingdata"); ?>'>View Data</a></li>
            <li><a href=''>Tambah konten</a></li>
            <li><a href=''>Edit konten</a></li>
        </ul>
 
    <div style="color: red;"><?php echo validation_errors(); ?></div>

	
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3>Data Pemasukan <small>Overview</small></h3>
        </div>
		
           <div class="box-body">
		   <div style="margin-bottom:20px"> 
			<?php echo form_open("Laporan/cari_pemasukan"); ?>
			<?php 
                  if( !empty($awal_pemasukan) && !empty($akhir_pemasukan)){ 
            ?>
		   		<input type="text" name="awal" id="awal" class="col-md-2 " placeholder="Dari Tanggal Travelling" required="required" value="<?=$awal_pemasukan?>"/>
				<input type="text" name="akhir" id="akhir" class="col-md-2 " placeholder="Hingga Tanggal Travelling" required="required" value="<?=$akhir_pemasukan?>"/>	
			<?php 
            	}else{
			?>
				<input type="text" name="awal" id="awal" class="col-md-2 " placeholder="Dari Tanggal Travelling" required="required" />
				<input type="text" name="akhir" id="akhir" class="col-md-2 " placeholder="Hingga Tanggal Travelling" required="required" />
				
			<?php } ?>
			<input type="submit" class="btn btn-primary" value="Cari" style="margin-bottom:0">
			<?=form_close()?>
			<a href="<?=base_url('Laporan')?>"><button class="btn btn-success" style="margin-left:0">Unfilter</button></a>	
			</div>
						
            <div class="table-responsive">
            <table id="table_content" class="table table-bordered">
            	<thead>
                	<tr>
                    	<th>No</th>
                    	<th>ID Booking</th>
                    	<th>Tanggal Booking</th>
                    	<th>Tanggal Travelling</th>
                    	<th>Biaya Travelling</th>
                    	<th>Biaya Tambahan</th>
                    	<th>Keuntungan</th>

                    </tr>
                </thead>
                <tbody id="dataHotel">
                <?php 
            	$no =1;
				$total=0;
                  if( !empty($data)){ 
            		foreach($data as $data){
            		?>
            	    	<tr>
                    	<td><?=$no?></td>	
                    	<td><?=$data->id_booking?></td>
                    	<td><?=$data->tgl_booking?></td>
                    	<td><?=$data->tgl_traveling?></td>
                    	<td>Rp.<?=$data->biaya_traveling?></td>
                    	<td>Rp.<?=($data->biaya_tambahan)?$data->biaya_tambahan:"0"?></td>
						<td>Rp.<?=(($data->biaya_traveling)+($data->biaya_tambahan))*25/100?></td>
						
            		</tr>
            		<?php
					$total=($total)+((($data->biaya_traveling)+($data->biaya_tambahan))*25/100);
            		$no++;
            				
            		}
            	}
            	?>
                </tbody>
            </table>
				<h1 style="float:right">
				<label >Total Pemasukan </label>
				<p style="width:30%;font-size:40px">Rp.<?=$total?></p>
				</h1>
			</div>
        </div>
    </div>
    </section>
	
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3>Data Pembatalan Booking <small>Overview</small></h3>
        </div>
		
           <div class="box-body">
		   <div style="margin-bottom:20px"> 
			<?php echo form_open("Laporan/cari_pembatalan"); ?>
			<?php 
                  if( !empty($awal_pembatalan) && !empty($akhir_pembatalan)){ 
            ?>
		   		<input type="text" name="awal_pembatalan" id="awal_pembatalan" class="col-md-2 " placeholder="Dari Tanggal Travelling" required="required" value="<?=$awal_pembatalan?>"/>
				<input type="text" name="akhir_pembatalan" id="akhir_pembatalan" class="col-md-2 " placeholder="Hingga Tanggal Travelling" required="required" value="<?=$akhir_pembatalan?>"/>
			<?php 
            	}else{
            ?>
		   		<input type="text" name="awal_pembatalan" id="awal_pembatalan" class="col-md-2 " placeholder="Dari Tanggal Travelling" required="required" />
				<input type="text" name="akhir_pembatalan" id="akhir_pembatalan" class="col-md-2 " placeholder="Hingga Tanggal Travelling" required="required" />	
			<?php } ?>
			<input type="submit" class="btn btn-primary" value="Cari" style="margin-bottom:0">	
			<?=form_close()?>	
			<a href="<?=base_url('Laporan')?>"><button class="btn btn-success" style="margin-left:0">Unfilter</button></a>	
		   </div>
						
            <div class="table-responsive">
            <table id="table_pembatalan" class="table table-bordered">
            	<thead>
                	<tr>
                    	<th>No</th>
                    	<th>ID Booking</th>
                    	<th>Tanggal Booking</th>
                    	<th>Tanggal Travelling</th>
                    	<th>Banyak Traveler</th>
                    	<th>Nama Paket</th>
                    </tr>
                </thead>
                <tbody id="dataHotel">
                <?php 
            	$no =1;
                  if( !empty($data_pembatalan)){ 
            		foreach($data_pembatalan as $data_pembatalan){
            		?>
            	    	<tr>
                    	<td><?=$no?></td>	
                    	<td><?=$data_pembatalan->id_booking?></td>
                    	<td><?=$data_pembatalan->tgl_booking?></td>
                    	<td><?=$data_pembatalan->tgl_traveling?></td>
                    	<td><?=$data_pembatalan->banyak_traveler?></td>
                    	<td><?=$data_pembatalan->nama_paket?></td>
						
            		</tr>
            		<?php
            		$no++;
            				
            		}
            	}
            	?>
                </tbody>
            </table>
				<h1 style="float:right">
				<label >Total Pembatalan </label>
				<p style="width:30%;font-size:40px"><?=$no-1?>x</p>
				</h1>
			</div>
        </div>
    </div>
 </section>

 <section class="content">
    <div class="box">
        <div class="box-header">
            <h3>Data Paket Terfavorit <small>Overview</small></h3>
        </div>
           <div class="box-body">
		   <div style="margin-bottom:20px"> 
			<?php echo form_open("Laporan/cari_paket"); ?>
			<?php 
                  if( !empty($awal_paket) && !empty($akhir_paket)){ 
            ?>
		   		<input type="text" name="awal_paket" id="awal_paket" class="col-md-2 " placeholder="Dari Tanggal Travelling" required="required" value="<?=$awal_paket?>"/>
				<input type="text" name="akhir_paket" id="akhir_paket" class="col-md-2 " placeholder="Hingga Tanggal Travelling" required="required" value="<?=$akhir_paket?>"/>
			<?php 
            	}else{
            ?>
				<input type="text" name="awal_paket" id="awal_paket" class="col-md-2 " placeholder="Dari Tanggal Travelling" required="required" />
				<input type="text" name="akhir_paket" id="akhir_paket" class="col-md-2 " placeholder="Hingga Tanggal Travelling" required="required"/>
			
			<?php } ?>
			<input type="submit" class="btn btn-primary" value="Cari" style="margin-bottom:0">	
			<?=form_close()?>
			<a href="<?=base_url('Laporan')?>"><button class="btn btn-success" style="margin-left:0">Unfilter</button></a>	
			</div>
						
            <div class="table-responsive">
            <table id="table_pembatalan" class="table table-bordered">
            	<thead>
                	<tr>
                    	<th>No</th>
                    	<th>Nama Paket</th>
                    	<th>Banyak Traveler</th>
                    	<th>Banyak Perjalanan</th>
                    </tr>
                </thead>
                <tbody id="dataHotel">
                <?php 
            	$no =1;
				$total_perjalanan=0;
                  if( !empty($data_paket)){ 
            		foreach($data_paket as $data_paket){
            		?>
            	    	<tr>
                    	<td><?=$no?></td>	
                    	<td><?=$data_paket->nama_paket?></td>
                    	<td><?=$data_paket->total_traveler?></td>
						<td><?=$data_paket->banyak_perjalanan?></td>
						
            		</tr>
            		<?php
					$total_perjalanan=$total_perjalanan+$data_paket->banyak_perjalanan;
            		$no++;
            				
            		}
            	}
            	?>
                </tbody>
            </table>
				<h1 style="float:right">
				<label >Total Perjalanan </label>
				<p style="width:30%;font-size:40px"><?=$total_perjalanan?>x</p>
				</h1>
			</div>
        </div>
    </div>
 </section>
 
<?php $this->load->view('admin/modal');?>
<script type="text/javascript">

	$(document).ready(function() {
		$("#awal").datepicker({
			dateFormat			: "yy-mm-dd",
			showOtherMonths		: true,
      		selectOtherMonths	: true,
				onClose: function( selectedDate ) {
					$( "#akhir" ).datepicker( "option", "minDate", selectedDate );
				  }
		});
		$("#akhir").datepicker({
			dateFormat			: "yy-mm-dd",
			showOtherMonths		: true,
      		selectOtherMonths	: true
		});
		$("#awal_pembatalan").datepicker({
			dateFormat			: "yy-mm-dd",
			showOtherMonths		: true,
      		selectOtherMonths	: true,
				onClose: function( selectedDate ) {
					$( "#akhir_pembatalan" ).datepicker( "option", "minDate", selectedDate );
				  }
		});
		$("#akhir_pembatalan").datepicker({
			dateFormat			: "yy-mm-dd",
			showOtherMonths		: true,
      		selectOtherMonths	: true
		});
		$("#awal_paket").datepicker({
			dateFormat			: "yy-mm-dd",
			showOtherMonths		: true,
      		selectOtherMonths	: true,
				onClose: function( selectedDate ) {
					$( "#akhir_paket" ).datepicker( "option", "minDate", selectedDate );
				  }
		});
		$("#akhir_paket").datepicker({
			dateFormat			: "yy-mm-dd",
			showOtherMonths		: true,
      		selectOtherMonths	: true
		});
	});

</script>	
</div>
</div>
</body>
</html>
