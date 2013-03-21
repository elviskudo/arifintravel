<?php echo $this->load->view('include/header'); ?>

	<?php echo $this->load->view('include/menu'); ?>
	
		<div id="middleantar">
			<div id="antar">
				<form id='formpemesanan' action="<?php echo base_url() ?>tiket/insert" method="post">
					<fieldset>
						<legend><strong>Form Pemesanan Tiket Pesawat</strong></legend>
						<div class='simple'>
							<label for="mata_uang">Dari</label>
							<input type='text' name="dari" value="<?php echo $dari ?>" readonly>
							
						</div>
						<div class='simple'>
							<label for="jenis">Tujuan</label>
							<input type="text" name="tujuan" value="<?php echo $tujuan ?>" readonly>
						</div>
						<div class='simple'>
							<label for="jumlah">Tanggal Berangkat</label>
							<input type="text" name="tgl_berangkat" value="<?php echo $tgl_berangkat; ?>" readonly>
						</div>
						<div class='simple'>
							<label for="kurs">Banyaknya Orang</label>
							<input type="text" name="orang" value="<?php echo $orang; ?>" readonly>
						</div>
						<div class='simple'>
							<label for="kurs">Jam</label>
							<input type="text" name="jam" value="<?php echo $jam; ?>" readonly>
						</div>
						<div class='simple'>
							<label for="kurs">Maskapai</label>
							<input type="text" name="maskapai" value="<?php echo $maskapai; ?>" readonly>
						</div>
						<div class='simple'>
							<label for="cabang">Cabang Pemesan</label>
						<select id='kota' name="kota" class='required'>
								<?php foreach($kota as $kt): ?>
								<option value="<?php echo $kt->id_kota ?>"><?php echo $kt->nama ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class='simple'>
							<label for="kurs">Kode Booking</label>
							<input type="text" name="kodeb">
						</div>
						<div class='simple'>
							<label for="biaya">Biaya</label>
							<input type="text" name="biaya">
						</div>
					</fieldset>
					<fieldset>
						<legend>Detail Pemesan</legend>
						<div class='simple'>
							<label for="nama">Nama </label>
							<input type='text' name="nama">
						</div>
						<div class='simple'>
							<label for="nama">No KTP / Passport </label>
							<input type='text' name="pengenal">
						</div>
						<div class='simple'>
							<label for="alamat">Alamat</label>
							<input type='text' name="alamat">
						</div>
						<div class='simple'>
							<label for="telp">No Telepon</label>
							<input type='text' name="telp">
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