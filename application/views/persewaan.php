<?php echo $this->load->view('include/header'); ?>

	<?php echo $this->load->view('include/menu'); ?>
	<script type="text/javascript">
	function popUp(mypage,w,h,scroll){
		LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
		TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
		settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+'';
		var myw = window.open(mypage,"myw",settings);
	}
</script>
		<div id="middleantar">
			<div id="antar">
			<h2>FORM ORDER SEWA MOBIL</h2><br>
				<form id='formpersewaan' name="persewaan" action="<?php echo base_url() ?>rental/insert" method="post">
					<fieldset>
						<legend><strong>Detail Pemesan</strong></legend>
						<div class='simple'>
						<label for="mata_uang">ID Member</label>
							
							<input type='text' name="id_member" value="<?php echo $id_member ?>" readonly>
							
						</div>
						<div class='simple'>
							<label for="jenis">Nama</label>
							<input type="text" name="nama" value="<?php echo $nama ?>" readonly>
						</div>
						<div class='simple'>
							<label for="jumlah">Alamat</label>
							<input type="text" name="alamat" value="<?php echo $alamat; ?>" readonly>
						</div>
						<div class='simple'>
							<label for="kurs">No. Identitas</label>
							<input type="text" name="no_id" value="<?php echo $no_id; ?>" readonly>
						</div>
						<div class='simple'>
							<label for="kurs">Telepon</label>
							<input type="text" name="telp" value="<?php echo $telp; ?>" readonly>
						</div>
						<div class='simple'>
							<label for="kurs">Tujuan</label>
							<input type="text" name="tujuan" value="<?php echo $tujuan; ?>" readonly>
						</div>
						<div class='simple'>
							<label for="cabang">Cabang Pemesan</label>
						<select id='kota' name="kota" class='required'>
								<option value="" selected></option>
								<?php foreach($kota as $kt): ?>
								<option value="<?php echo $kt->nama ?>"><?php echo $kt->nama ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						
					</fieldset>
					<fieldset>
						<legend>Detail Sewa</legend>
						<table cellpadding="5" cellspacing="5" width="520">
						<tr>
							<td width="100"><label for="nama">Jenis Mobil</label></td><td width="50">&nbsp;</td><td width="250">
							<input type="hidden" name="id_mobil"><input type='text' name="jenis" size="35"></td><td align="left"><?php echo "<a href=\"#\" onClick=\"popUp('".base_url()."popup/mobil',500,450,'yes');\">
			<img src=\"".base_url()."images/ew_find.gif\" border=\"0\" id=\"cx_find\" alt=\"Find\" style=\"cursor:pointer;cursor:hand;\">
			 CARI DATA MOBIL</a>"; ?></td>
						</tr>
						
						</table>
						
						<div class='simple'>
							<label for="nama">Plat Nomor</label>
							<input type='text' name="plat">
						</div>
						<div class='simple'>
							<label for="alamat">Tarif</label>
							<input type='text' name="tarif">
						</div>
						<table cellpadding="5" cellspacing="5" width="520">
						<tr>
							<td width="100"><label for="nama">Tgl Pemakaian</label></td><td width="50">&nbsp;</td><td width="140"><input type='text' name="tgl_mulai" class="date-pick" size="13"></td><td width="30" align="center">s/d</td><td width="140"><input type='text' name="tgl_akhir" class="date-pick" size="13"></td><td></td>
						</tr>
						
						</table>
						<div class='simple'>
							<label for="nama">Jaminan</label>
							<input type='text' name="jaminan">
						</div>
						<div class='simple'>
							<label for="telp">Catatan</label>
							<textarea cols="22" rows="5" name="catatan">
							</textarea>
						</div>
						<div class='simple'>
							<label for="submit">&nbsp;</label>
							<input type="submit" name="submit" value="Kirim">
						</div>
					</fieldset>
				
					</form>
					</div>
					
</div><!--#middle-->
		
	</div><!--#content-->

<?php echo $this->load->view('include/footer'); ?>