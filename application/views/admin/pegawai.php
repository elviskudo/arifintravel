<?php if($this->session->userdata('email')): ?>

<?php echo $this->load->view('admin/include/header'); ?>

<div id="content">
	<div id="admin-left">
		<div id='ajax-content'>
			<table id='blog'>
				<caption>
					Pegawai [<?php echo $total ?> data]
					<div class='insert' style='float:right;text-transform:lowercase;'>
						<a href="<?php echo base_url() ?>admin/pegawai/insert/">
							<img src="<?php echo base_url() ?>images/insert.gif" alt="Tambah Data">
							Tambah Data
						</a>
					</div>
				</caption>
				<thead>
					<tr>
						<th class='no'>No</th>
						<th>Tanggal</th>
						<th>Email</th>
						<th>Cabang</th>
						<th>Kota</th>
						<th>Telpon</th>
						<th>HP</th>
						<th class='action'>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $num = 1; ?>
					<?php foreach($pegawai as $row): ?>
					<tr>
						<td><?php echo $num ?></td>
						<td><?php echo date('d M Y', $row->tanggal) ?></td>
						<td><?php echo $row->email ?></td>
						<td><?php echo $row->cabang ?></td>
						<td><?php echo $row->kota ?></td>
						<td><?php echo $row->telpon ?></td>
						<td><?php echo $row->hp ?></td>
						<td>
							<a href="<?php echo base_url() ?>admin/pegawai/update_pegawai/<?php echo $row->id_admin ?>">
								<img src="<?php echo base_url() ?>images/update.gif" alt="Edit Data" title="Edit Data">
							</a>
							<a href="<?php echo base_url() ?>admin/pegawai/delete_pegawai/<?php echo $row->id_admin ?>" onclick="return confirm('Apakah kamu yakin untuk menghapus pegawai ini?')">
								<img src="<?php echo base_url() ?>images/delete.gif" alt="Hapus Data" title="Hapus Data">
							</a>
						</td>
					</tr>
					<?php $num++; ?>
					<?php endforeach; ?>
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
			<legend>Update pegawai</legend>
			<form id='update' action="<?php echo base_url() ?>admin/pegawai/update_pegawai_y/" method="post" accept-charset="utf-8" enctype='multipart/form-data'>
				<input type="hidden" name="id_admin" value="<?php echo $this->session->userdata('id_admin'); ?>">
				<?php foreach($getpegawai as $gb): ?>
				<div class="simple">
					<label for="nama">Nama</label>
					<input type='text' id='nama' name="nama" value="<?php echo $gb->nama ?>" class='required'>
				</div>
				<div class="simple">
					<label for="cabang">Cabang</label>
					<select id='cabang' name="cabang" class='required'>
						<?php foreach($cabang as $cb): ?>
							<?php $selected = ($gb->id_cabang == $cb->id_cabang) ? ' selected' : '' ?>
						<option value="<?php echo $cb->id_cabang ?>"<?php echo $selected ?>><?php echo $cb->nama ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="simple">
					<label for="email">Email</label>
					<input type='text' id='email' name="email" autocomplete="off" value="<?php echo $gb->email ?>" class='required'>
				</div>
				<div class="simple">
					<label for="password">Password</label>
					<input type='text' id='password' name="password" value="<?php echo $gb->password ?>" class='required'>
				</div>
				<div class="simple">
					<label for="kota">Kota</label>
					<input type='text' id='kota' name="kota" value="<?php echo $gb->kota ?>" class='required'>
				</div>
				<div class="simple">
					<label for="telpon">Telpon</label>
					<input type='text' id='telpon' name="telpon" value="<?php echo $gb->telpon ?>" class='required'>
				</div>
				<div class="simple">
					<label for="hp">HP</label>
					<input type='text' id='hp' name="hp" value="<?php echo $gb->hp ?>" class='required'>
				</div>
					<?php $this->session->unset_userdata('error'); ?>
				<?php endforeach; ?>
			<?php else: ?>
			<legend>Tambah pegawai</legend>
			<?php echo validation_errors('<div class="error">', '</div>'); ?>
			<form id='insert' action="<?php echo base_url() ?>admin/pegawai/insert_pegawai/" method="post" enctype="multipart/form-data" accept-charset="utf-8">
				<div class="simple">
					<label for="nama">Nama</label>
					<input type='text' id='nama' name="nama" value="<?php echo set_value('nama') ?>" class='required'>
				</div>
				<div class="simple">
					<label for="cabang">Cabang</label>
					<select id='cabang' name="cabang" class='required'>
						<?php foreach($cabang as $cb): ?>
							<?php $selected = (set_value('cabang') == $cb->id_cabang) ? ' selected' : '' ?>
						<option value="<?php echo $cb->id_cabang ?>"<?php echo $selected ?>><?php echo $cb->nama ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="simple">
					<label for="email">Email</label>
					<input type='text' id='email' name="email" autocomplete="off" value="<?php echo set_value('email') ?>" class='required'>
				</div>
				<div class="simple">
					<label for="password">Password</label>
					<input type='text' id='password' name="password" value="<?php echo set_value('password') ?>" class='required'>
				</div>
				<div class="simple">
					<label for="kota">Kota</label>
					<input type='text' id='kota' name="kota" value="<?php echo set_value('kota') ?>" class='required'>
				</div>
				<div class="simple">
					<label for="telpon">Telpon</label>
					<input type='text' id='telpon' name="telpon" value="<?php echo set_value('telpon') ?>" class='required'>
				</div>
				<div class="simple">
					<label for="hp">HP</label>
					<input type='text' id='hp' name="hp" value="<?php echo set_value('hp') ?>" class='required'>
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
