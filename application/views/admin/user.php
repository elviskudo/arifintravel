<?php if($this->session->userdata('email')): ?>

<?php echo $this->load->view('admin/include/header'); ?>

<div id="content">
	<div id="admin-left">
		<div id='ajax-content'>
			<table id='user'>
				<caption>
					manajemen user [<?php echo $total ?> data]
					<div class='insert' style='float:right;text-transform:lowercase;'>
						<a href="<?php echo base_url() ?>admin/user/insert/">
							<img src="<?php echo base_url() ?>images/insert.gif" alt="Tambah Data">
							Tambah Data
						</a>
					</div>
				</caption>
				<thead>
					<tr>
						<th class='no'>No</th>
						<th>Id</th>
						<th>Nama</th>
						<th>Email</th>
						<th>HP</th>
						<th>Level</th>
						<th class='action'>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if($alluser): ?>
						<?php $num = 1; ?>
					<?php foreach($alluser as $row): ?>
						<?php if($num % 2 == 0): ?>
					<tr class='even'>
						<?php else: ?>
					<tr>
						<?php endif; ?>
						<td><?php echo $num ?></td>
						<td><?php echo $row->id_user ?></td>
						<td><?php echo $row->nama ?></td>
						<td><?php echo $row->email ?></td>
						<td><?php echo $row->hp ?></td>
						<td>
							<?php if($row->level == 1): ?>
							Admin
							<?php else: ?>
							Guest
							<?php endif; ?>
						</td>
						<td>
							<a href="<?php echo base_url() ?>admin/user/change_admin/<?php echo $row->id_user ?>" onclick="return confirm('Apakah kamu yakin untuk menset pengguna ini berstatus admin?')">
								<img src="<?php echo base_url() ?>images/set.gif" alt="Default Admin" title="Default Admin">
							</a>
							<a href="<?php echo base_url() ?>admin/user/update_user/<?php echo $row->id_user ?>">
								<img src="<?php echo base_url() ?>images/update.gif" alt="Edit Data" title="Edit Data">
							</a>
							<a href="<?php echo base_url() ?>admin/user/delete_user/<?php echo $row->id_user ?>" onclick="return confirm('Apakah kamu yakin untuk menghapus pengguna ini?')">
								<img src="<?php echo base_url() ?>images/delete.gif" alt="Hapus Data" title="Hapus Data">
							</a>
						</td>
					</tr>
					<?php $num++; ?>
					<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
			<ul id="pagination-digg" class='ajax-page' style='margin-bottom:40px;'>
				<?php echo $this->pagination->create_links(); ?>
			</ul>
		</div>
		<div class='clear'></div>
		
		<?php if($this->session->userdata('error')):?>
		<div class='error'><?php echo $this->session->userdata('error'); ?></div>
		<?php endif; ?>
		<fieldset>
			<?php if($this->session->userdata('update') == 'yes'): ?>
			<legend>Update user</legend>
			<form id='update' action="<?php echo base_url() ?>admin/user/update_user_y/" method="post" accept-charset="utf-8">
				<input type="hidden" name="id_user" value="<?php echo $this->session->userdata('id_user'); ?>">
				<?php foreach($getuser as $gu): ?>
				<div class="simple">
					<label for="email">Email</label>
					<input type='text' name="emailn" value="<?php echo $gu->email ?>">
				</div>
				<div class="simple">
					<label for="password">Ganti Password</label>
					<input type='password' name="password" value="">
					<span>Biarkan kosong jika tidak ganti password</span>
				</div>
				<div class="simple">
					<label for="nama">Nama</label>
					<input type='text' name="nama" value="<?php echo $gu->nama ?>">
				</div>
				<div class="simple">
					<label for="ktp">Ktp</label>
					<input type='text' name="ktp" value="<?php echo $gu->ktp ?>">
				</div>
				<div class="simple">
					<label for="jenis_kelamin">Jenis Kelamin</label>
					<select name="jenis_kelamin">
						<?php if($gu->jenis_kelamin == 1): ?>
						<option value="1" selected>Laki-laki</option>
						<option value="0">Perempuan</option>
						<?php else: ?>
						<option value="1">Laki-laki</option>
						<option value="0" selected>Perempuan</option>
						<?php endif; ?>
					</select>
				</div>
				<div class="simple">
					<label for="menikah">Status Menikah</label>
					<select name="menikah">
						<?php if($gu->menikah == 'belum'): ?>
						<option value="belum" selected>Belum Menikah</option>
						<option value="menikah">Menikah</option>
						<option value="duda">Duda</option>
						<option value="janda">Janda</option>
						<?php elseif($gu->menikah == 'menikah'): ?>
						<option value="belum">Belum Menikah</option>
						<option value="menikah" selected>Menikah</option>
						<option value="duda">Duda</option>
						<option value="janda">Janda</option>
						<?php elseif($gu->menikah == 'duda'): ?>
						<option value="belum">Belum Menikah</option>
						<option value="menikah">Menikah</option>
						<option value="duda" selected>Duda</option>
						<option value="janda">Janda</option>
						<?php elseif($gu->menikah == 'janda'): ?>
						<option value="belum">Belum Menikah</option>
						<option value="menikah">Menikah</option>
						<option value="duda">Duda</option>
						<option value="janda" selected>Janda</option>
						<?php endif; ?>
					</select>
				</div>
				<div class="simple">
					<label for="alamat">Alamat</label>
					<input type='text' name="alamat" value="<?php echo $gu->alamat ?>">
				</div>
				<div class="simple">
					<label for="kota">Kota</label>
					<input type='text' name="kota" value="<?php echo $gu->kota ?>">
				</div>
				<div class="simple">
					<label for="propinsi">Propinsi</label>
					<input type='text' name="propinsi" value="<?php echo $gu->propinsi ?>">
				</div>
				<div class="simple">
					<label for="kode_area">Kode Area</label>
					<input type='text' name="kode_area" value="<?php echo $gu->kode_area ?>">
				</div>
				<div class="simple">
					<label for="telpon">Telpon</label>
					<input type='text' name="telpon" value="<?php echo $gu->telpon ?>">
				</div>
				<div class="simple">
					<label for="hp">HP</label>
					<input type='text' name="hp" value="<?php echo $gu->hp ?>">
				</div>
				<div class="simple">
					<label for="deskripsi">Deskripsi</label>
					<textarea name="deskripsi"><?php echo $gu->deskripsi ?></textarea>
				</div>
				<?php endforeach; ?>
					<?php $this->session->unset_userdata('error'); ?>
				<?php else: ?>
			<legend>Tambah user</legend>
			<?php echo validation_errors('<div class="error">', '</div>'); ?>
			<form id='insert' action="<?php echo base_url() ?>admin/user/insert_user/" method="post" accept-charset="utf-8">
				<div class="simple">
					<label for="email">Email</label>
					<input type='text' name="emailn" value="<?php echo set_value('email') ?>">
				</div>
				<div class="simple">
					<label for="password">Password</label>
					<input type='password' name="password" value="">
				</div>
				<div class="simple">
					<label for="confirm">Konfirmasi</label>
					<input type='password' name="confirm" value="">
				</div>
				<div class="simple">
					<label for="nama">Nama</label>
					<input type='text' name="nama" value="<?php echo set_value('nama') ?>">
				</div>
				<div class="simple">
					<label for="ktp">Ktp</label>
					<input type='text' name="ktp" value="<?php echo set_value('ktp') ?>">
				</div>
				<div class="simple">
					<label for="jenis_kelamin">Jenis Kelamin</label>
					<select name="jenis_kelamin">
						<option value="1" selected>Laki-laki</option>
						<option value="0">Perempuan</option>
					</select>
				</div>
				<div class="simple">
					<label for="menikah">Status Menikah</label>
					<select name="menikah">
						<option value="belum" selected>Belum Menikah</option>
						<option value="menikah">Menikah</option>
						<option value="duda">Duda</option>
						<option value="janda">Janda</option>
					</select>
				</div>
				<div class="simple">
					<label for="alamat">Alamat</label>
					<input type='text' name="alamat" value="<?php echo set_value('alamat') ?>">
				</div>
				<div class="simple">
					<label for="kota">Kota</label>
					<input type='text' name="kota" value="<?php echo set_value('kota') ?>">
				</div>
				<div class="simple">
					<label for="propinsi">Propinsi</label>
					<input type='text' name="propinsi" value="<?php echo set_value('propinsi') ?>">
				</div>
				<div class="simple">
					<label for="kode_area">Kode Area</label>
					<input type='text' name="kode_area" value="<?php echo set_value('kode_area') ?>">
				</div>
				<div class="simple">
					<label for="telpon">Telpon</label>
					<input type='text' name="telpon" value="<?php echo set_value('telpon') ?>">
				</div>
				<div class="simple">
					<label for="hp">HP</label>
					<input type='text' name="hp" value="<?php echo set_value('hp') ?>">
				</div>
				<div class="simple">
					<label for="deskripsi">Deskripsi</label>
					<textarea name="deskripsi"><?php echo set_value('deskripsi') ?></textarea>
				</div>
				<?php endif; ?>
				<div class="simple">
					<label for='submit'>&nbsp;</label>
					<input type="submit" value="Simpan">
				</div>
			</form>
		</fieldset>
		<div class='clear'></div>
	</div><!--#left-->

<?php echo $this->load->view('admin/include/right'); ?>

</div><!--#content-->
<div class='clear'></div>

<?php echo $this->load->view('admin/include/footer'); ?>

<?php else: ?>

<?php echo $this->load->view('admin/include/login'); ?>

<?php endif; ?>
