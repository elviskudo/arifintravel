<?php echo $this->load->view('include/header'); ?>

	<?php echo $this->load->view('include/menu'); ?>
	
		<div id="middleantar">
			<div id="antar">
				<form id='formAntar' action="<?php echo base_url() ?>daftar/insert" method="post">
					<fieldset>
						<legend>Form Pendaftaran Calon Penumpang</legend>
						<?php if($this->session->userdata('error')): ?>
						<div class='error'><?php echo $this->session->userdata('error'); ?></div>
						<?php endif; ?>
						<?php echo validation_errors('<div class="error">', '</div>'); ?>
						<div class='simple'>
							<label for="emailn">Email</label>
							<input type="text" id='emailn' name="emailn" value="" class='required'>
						</div>
						<div class='simple'>
							<label for="password">Password</label>
							<input type="password" id='password' name="password" value="" class='required'>
						</div>
						<div class='simple'>
							<label for="confirm">Konfirmasi</label>
							<input type="password" id='confirm' name="confirm" value="" class='required'>
						</div>
						<div class='simple'>
							<label for="nama">Nama</label>
							<input type="text" id='nama' name="nama" value="" class='required'>
						</div>
						<div class='simple'>
							<label for="ktp">No. Paspor/KTP</label>
							<input type="text" id='ktp' name="ktp" value="" class='required'>
						</div>
						<div class='simple'>
							<label for="jenis_kelamin">Jenis Kelamin</label>
							<select name="jenis_kelamin">
								<option value="1">Laki-laki</option>
								<option value="0">Perempuan</option>
							</select>
						</div>
						<div class='simple'>
							<label for="menikah">Status Menikah</label>
							<select name="menikah">
								<option value="belum">Belum Menikah</option>
								<option value="menikah">Menikah</option>
								<option value="duda">Duda</option>
								<option value="janda">Janda</option>
							</select>
						</div>
						<div class='simple'>
							<label for="alamat">Alamat</label>
							<textarea id='alamat' name="alamat" class='required'></textarea>
						</div>
						<div class='simple'>
							<label for="kota">Kota</label>
							<input type="text" id='kota' name="kota" value="" class='required'>
						</div>
						<div class='simple'>
							<label for="propinsi">Propinsi</label>
							<input type="text" id='propinsi' name="propinsi" value="" class='required'>
						</div>
						<div class='simple'>
							<label for="kode_area">Kode Pos</label>
							<input type="text" id='kode_area' name="kode_area" value="" class='required'>
						</div>
						<div class='simple'>
							<label for="telpon">Telpon</label>
							<input type="text" id='telpon' name="telpon" value="" class='required'>
						</div>
						<div class='simple'>
							<label for="hp">HP</label>
							<input type="text" name="hp" value="">
						</div>
						<div class='simple'>
							<label for="deskripsi">Deskripsi</label>
							<textarea name="deskripsi"></textarea>
						</div>
						<div class='simple'>
							<label for="submit">&nbsp;</label>
							<input type="submit" name="submit" value="Simpan">
						</div>
					</fieldset>
				</form>
			</div>
		</div><!--#middle-->
		
	</div><!--#content-->

<?php echo $this->load->view('include/footer'); ?>