<html>  
	<head>    
		<title>Form Ubah - CRUD Codeigniter</title>  
	</head>  
		

<body>
    <div style="color: red;"><?php echo validation_errors(); ?></div>

<?php echo form_open_multipart("Main/edit"/$user->user_id); ?>    <!-- sama dengan form post dan action -->
<table border="0" cellpadding="5" cellspacing="0">
    <tbody>
	    
        	<td>Username</td>
        	<td>:</td>
        	<td><input type="text" name="user" maxlength="20" required value="<?php echo set_value('user', $user->username); ?>"/></td>
        </tr>
    	<tr>
        	<td>Password</td>
        	<td>:</td>
        	<td><input type="password" name="pass" maxlength="20" required value="<?php echo set_value('pass', $user->password); ?>"/></td>
        </tr>
    	<tr>
        	<td>Fullname</td>
        	<td>:</td>
        	<td><input type="text" name="fullnm" maxlength="100" required value="<?php echo set_value('fullnm', $user->fullname); ?>"/></td>
        </tr>
    	<tr>
        	<td>Email</td>
        	<td>:</td>
        	<td><input type="email" name="email" required value="<?php echo set_value('email', $user->email); ?>"/></td>
        </tr>
    	<tr>
        	<td>Agama</td>
        	<td>:</td>
        	<td><input type="text" name="agama" required value="<?php echo set_value('agama', $user->agama); ?>"/></td>
        </tr>
    	<tr>
        	<td>Nomor HP</td>
        	<td>:</td>
        	<td><input type="text" name="hp" maxlength="14" required value="<?php echo set_value('no_hp', $user->no_hp); ?>" /></td>
        </tr>
		<tr>
		    <td>Foto</td>
        	<td>:</td>
			<td><img src="<?=base_url().'image/'.$user->nama_file;?>" width="100"></td> 
				<input name="file_lama" type="text" value="<?=$user->nama_file;?>" hidden> 
			<td><input type="file" name="file" ></td> 
		</tr>
		<tr>
        	<td align="right" colspan="3">
			<input type="submit" name="submit" value="Simpan" />
			 <a href="<?php echo base_url(); ?>"><input type="button" value="ulang" /></a>
			</td>
        </tr>
    </tbody>
</table>
<?php echo form_close();?>

</body>
</html>