<?php echo $this->load->view('include/header'); ?>

	<?php echo $this->load->view('include/menu'); ?>
	
		<div id="middleantar">
			<div id="antar">
				<form id='formAntar' action="<?php echo base_url() ?>daftar/update" method="post">
					<fieldset>
						<legend>Form Pendaftaran Calon Penumpang</legend>
						<?php if($this->session->userdata('error')): ?>
						<div class='error'><?php echo $this->session->userdata('error'); ?></div>
						<?php endif; ?>
						<?php echo validation_errors('<div class="error">', '</div>'); ?>
						<?php foreach($bio as $row): ?>
						<input type="hidden" name="id_user" value="<?php echo $this->session->userdata('id_user'); ?>">
						<div class='simple'>
							<label for="emailn">Email</label>
							<input type="text" id='emailn' name="emailn" value="<?php echo $row->email ?>" readonly>
						</div>
						<div class='simple'>
							<label for="password">Password</label>
							<div style='overflow:hidden'>
								<input type="password" id='password' name="password" value="">
								<span style='display:block;color:red;font-style:italic'>biarkan kosong bila tidak dirubah</span>
							</div>
						</div>
						<div class='simple'>
							<label for="nama">Nama</label>
							<input type="text" id='nama' name="nama" value="<?php echo $row->nama ?>" class='required'>
						</div>
						<div class='simple'>
							<label for="ktp">No. Paspor/KTP</label>
							<input type="text" id='ktp' name="ktp" value="<?php echo $row->ktp ?>" class='required'>
						</div>
						<div class='simple'>
							<label for="jenis_kelamin">Jenis Kelamin</label>
							<select name="jenis_kelamin">
								<?php if($row->jenis_kelamin == 1): ?>
								<option value="1" selected='selected'>Laki-laki</option>
								<option value="0">Perempuan</option>
								<?php else: ?>
								<option value="1">Laki-laki</option>
								<option value="0" selected='selected'>Perempuan</option>
								<?php endif; ?>
							</select>
						</div>
						<div class='simple'>
							<label for="menikah">Status Menikah</label>
							<select name="menikah">
								<?php if($row->menikah === 'belum'): ?>
								<option value="belum" selected>Belum Menikah</option>
								<option value="menikah">Menikah</option>
								<option value="duda">Duda</option>
								<option value="janda">Janda</option>
								<?php elseif($row->menikah === 'menikah'): ?>
								<option value="belum">Belum Menikah</option>
								<option value="menikah" selected>Menikah</option>
								<option value="duda">Duda</option>
								<option value="janda">Janda</option>
								<?php elseif($row->menikah === 'duda'): ?>
								<option value="belum">Belum Menikah</option>
								<option value="menikah">Menikah</option>
								<option value="duda" selected>Duda</option>
								<option value="janda">Janda</option>
								<?php elseif($row->menikah === 'janda'): ?>
								<option value="belum">Belum Menikah</option>
								<option value="menikah">Menikah</option>
								<option value="duda">Duda</option>
								<option value="janda" selected>Janda</option>
								<?php endif; ?>
							</select>
						</div>
						<div class='simple'>
							<label for="alamat">Alamat</label>
							<textarea id='alamat' name="alamat" class='required'><?php echo $row->alamat ?></textarea>
						</div>
						<div class='simple'>
							<label for="kota">Kota</label>
							<input type="text" id='kota' name="kota" value="<?php echo $row->kota ?>" class='required'>
						</div>
						<div class='simple'>
							<label for="propinsi">Propinsi</label>
							<input type="text" id='propinsi' name="propinsi" value="<?php echo $row->propinsi ?>" class='required'>
						</div>
						<div class='simple'>
							<label for="kode_area">Kode Pos</label>
							<input type="text" id='kode_area' name="kode_area" value="<?php echo $row->kode_area ?>" class='required'>
						</div>
						<div class='simple'>
							<label for="telpon">Telpon</label>
							<input type="text" id='telpon' name="telpon" value="<?php echo $row->telpon ?>" class='required'>
						</div>
						<div class='simple'>
							<label for="hp">HP</label>
							<input type="text" name="hp" value="<?php echo $row->hp ?>">
						</div>
						<div class='simple'>
							<label for="deskripsi">Deskripsi</label>
							<textarea name="deskripsi"><?php echo $row->deskripsi ?></textarea>
						</div>
						<?php endforeach; ?>
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