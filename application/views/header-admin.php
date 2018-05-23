<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/dashboard-admin/datatables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/dashboard-admin/datatables/dataTables.bootstrap.min.js"></script>
		<script src="assets/js/jquery.flexslider-min.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/js/jquery-ui.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#table_booking').DataTable({
					scrollX:true
				});
			});

            $(document).ready(function(){
                $('#table_content').DataTable({

				});
				
            });

            $(document).ready(function(){
                $('#table_pembatalan').DataTable();
            });

            $(document).ready(function(){
                $('#table_paket_populer').DataTable();
            });

            $(document).ready(function(){
                $('#table_contact').DataTable();
            });
        </script>
		
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/dashboard-admin/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/dashboard-admin/css/style-admin.css" />
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/dashboard-admin/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/dashboard-admin/datatables/dataTables.bootstrap.css" />
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.css" type="text/css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/css/datepicker.css" type="text/css">
        
        <link rel="shortcut icon" href="<?=base_url()?>image/fav.png" />


    </head>
<body>


<!--Navigation-->
<div class="wrapper">
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="#" class="navbar-brand">Tour & Travel</a>
    </div>

    <div class="collapse navbar-collapse collapse-in" id="navigation">
        <ul class="nav navbar-nav side-nav">
            <div class="user-panel">
                <div class="pull-left image">
                   <i class="fa fa-user" title="Admin" style="color:#fff; width:100%; margin:6px 0 0 30px"></i>
                </div>

                <div class="pull-left info">
                    <p>Admin</p>
                    <a href=""><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <li><a href="<?=base_url('admin')?>">Dashboard</a></li>
            <li><a href="<?=base_url('Hotel')?>">Data Hotel</a></li>
            <li><a href="<?=base_url('Wisata')?>">Data Wisata</a></li>
            <li><a href="<?=base_url('Paketdata')?>">Data Paket Wisata</a></li>
            <li><a href="<?=base_url('Momentdata')?>">Data Moment</a></li>
            <li><a href="<?=base_url('Bookingdata')?>">Data Booking</a></li>
            <li><a href="<?=base_url('Pembayarandata')?>">Data Pembayaran</a></li>
            <li><a href="<?=base_url('Laporan')?>">Laporan</a></li>

        </ul>


        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span>Admin</span>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <!--<li><a href="#"><i class="fa fa-fw fa-user"></i> Profile</a></li>
                    <li><a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a></li>
                    <li><a href="#"><i class="fa fa-fw fa-cog"></i> Settings</span></a></li> !-->
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url('Admin/logout'); ?>"><i class="fa fa-fw fa-power-off"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>