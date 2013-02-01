<?php echo $this->load->view('include/header'); ?>

	<?php echo $this->load->view('include/menu'); ?>
	
		<div id="middleantar">
			<div id="antar">
				<form id='formAntar' action="<?php echo base_url() ?>login" method="post" accept-charset="utf-8">
					<input type="hidden" name="id_kota" value="<?php echo $this->input->post('kota'); ?>">
					<input type="hidden" name="orang" value="<?php echo $this->input->post('orang'); ?>">
					<input type="hidden" name="login_type" value="antar">
					<fieldset>
						<legend>Tabel Pilihan Waktu Keberangkatan</legend>
						<div class="simple">
							<label for="kota">Dari kota</label>
							<input type='text' name="kota" value='<?php echo $kota; ?>' readonly>
						</div>
						<div class="simple">
							<label for="tujuan">Tujuan</label>
							<input type='text' name="tujuan" value='Juanda Surabaya' readonly>
						</div>
						<div class="simple">
							<label for='waktu'>Tanggal</label>
							<input type='text' name="waktu" value="<?php echo $this->input->post('tanggal_antar'); ?>" readonly>
						</div>
						<div class='tabel' style='width:60px'>
							<hr><p class='awal'>Pilih<br>Jam</p><hr>
							<?php $n = 1; ?>
							<?php foreach($jam as $jm): ?>
							<div>
								<input type="radio" id='jam_<?php echo $n ?>' name="jam[]" value="<?php echo $jm->id_jam ?>" class="required">
							</div>
								<?php $n++; ?>
							<?php endforeach; ?>
						</div>
						<div class='tabel' style='width:140px;'>
							<hr><p class='awal'>No.<br>Pesawat</p><hr>
							<?php foreach($jam as $jm): ?>
								<div>
								<?php echo $jm->no ?>
								</div>
							<?php endforeach; ?>
						</div>
						<div class='tabel' style='width:170px;'>
							<hr><p class='awal'>Nama<br>Pesawat</p><hr>
							<?php foreach($jam as $jm): ?>
								<div>
								<?php echo $jm->nama ?>
								</div>
							<?php endforeach; ?>
						</div>
						<div class='tabel' style='width:150px;'>
							<hr><p class='awal'><?php echo $kota ?><br>jam</p><hr>
							<?php foreach($jam as $jm): ?>
								<div>
								<?php echo $jm->jam ?>
								</div>
							<?php endforeach; ?>
						</div>
						<div class='tabel akhir' style='margin-bottom:20px'>
							<hr><p class='awal'>Penerbangan<br>jam</p><hr>
							<?php foreach($jam as $jm): ?>
								<div>
								<?php echo $jm->jam_ps ?>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="simple">
							<label for="submit">&nbsp;</label>
							<input type="submit" name="submit" value="Simpan">
						</div>
					</fieldset>
				</form>
			</div>
		</div><!--#middle-->
		
	</div><!--#content-->

<?php echo $this->load->view('include/footer'); ?>