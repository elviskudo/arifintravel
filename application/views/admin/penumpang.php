<?php if($this->session->userdata('email')): ?>

<?php echo $this->load->view('admin/include/header'); ?>

<div id="content">
	<div id="admin-left">
		<table id='blog'>
			<caption>
				penumpang
				<div class='insert' style='float:right;text-transform:lowercase;'>
					<a href="<?php echo base_url() ?>admin/penumpang/insert/">
						<img src="<?php echo base_url() ?>images/insert.gif" alt="Tambah Data">
						Tambah Data
					</a>
				</div>
			</caption>
			<thead>
				<tr>
					<th class='no'>No</th>
					<th>No Invoice</th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Telpon</th>
					<th>Catatan</th>
					<th class='action'>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $num = 1; ?>
				<?php foreach($penumpang as $row): ?>
				<tr>
					<td><?php echo $num ?></td>
					<td><?php echo $row->no ?></td>
					<td><?php echo $row->nama ?></td>
					<td><?php echo $row->alamat ?></td>
					<td><?php echo $row->telpon ?></td>
					<td><?php echo $row->catatan ?></td>
					<td>
						<a href="<?php echo base_url() ?>admin/penumpang/update_penumpang/<?php echo $row->id_penumpang ?>">
							<img src="<?php echo base_url() ?>images/update.gif" alt="Edit Data" title="Edit Data">
						</a>
						<a href="<?php echo base_url() ?>admin/penumpang/delete_penumpang/<?php echo $row->id_penumpang ?>" onclick="return confirm('Apakah kamu yakin untuk menghapus penumpang ini?')">
							<img src="<?php echo base_url() ?>images/delete.gif" alt="Hapus Data" title="Hapus Data">
						</a>
					</td>
				</tr>
				<?php $num++; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
		<!--<ul id="pagination-digg" class='ajax-page' style='margin-bottom:40px;'>
			<?php //echo $this->pagination->create_links(); ?>
		</ul>-->
		<div class='clear'></div>
		
		<?php if($this->session->userdata('error')):?>
		<div class='error'><?php echo $this->session->userdata('error'); ?></div>
		<?php endif; ?>
		<fieldset>
			<?php if($this->session->userdata('update') == 'yes'): ?>
			<legend>Update penumpang</legend>
			<form id='update' action="<?php echo base_url() ?>admin/penumpang/update_penumpang_y/" method="post" accept-charset="utf-8" enctype='multipart/form-data'>
				<input type="hidden" name="id_penumpang" value="<?php echo $this->session->userdata('id_penumpang'); ?>">
				<?php foreach($getpenumpang as $gb): ?>
				<div class="simple">
					<label for="no">No Invoice</label>
					<input type='text' name="no" value='<?php echo $gb->no ?>' readonly>
				</div>
				<div class="simple">
					<label for="nama">Nama</label>
					<input type='text' id='nama' name="nama" value='<?php echo $gb->nama ?>' class='required'>
				</div>
				<div class="simple">
					<label for="alamat">Alamat</label>
					<input type='text' id='alamat' name="alamat" value='<?php echo $gb->alamat ?>' class='required'>
				</div>
				<div class="simple">
					<label for="telpon">Telpon</label>
					<input type='text' id='telpon' name="telpon" value='<?php echo $gb->telpon ?>' class='required'>
				</div>
				<div class="simple">
					<label for="catatan">catatan</label>
					<textarea id='catatan' name="catatan"><?php echo $gb->catatan ?></textarea>
				</div>
					<?php $this->session->unset_userdata('error'); ?>
				<?php endforeach; ?>
			<?php else: ?>
			<legend>Tambah penumpang</legend>
			<?php echo validation_errors('<div class="error">', '</div>'); ?>
			<form id='insert' action="<?php echo base_url() ?>admin/penumpang/insert_penumpang/" method="post" enctype="multipart/form-data" accept-charset="utf-8">
				<div class="simple">
					<label for="no">No Invoice</label>
					<input type='text' id='no' name="no" value='' class='required'>
				</div>
				<div class="simple">
					<label for="nama">Nama</label>
					<input type='text' id='nama' name="nama" value='' class='required'>
				</div>
				<div class="simple">
					<label for="alamat">Alamat</label>
					<input type='text' id='alamat' name="alamat" value='' class='required'>
				</div>
				<div class="simple">
					<label for="telpon">Telpon</label>
					<input type='text' id='telpon' name="telpon" value='' class='required'>
				</div>
				<div class="simple">
					<label for="catatan">catatan</label>
					<textarea id='catatan' name="catatan"></textarea>
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
