<?php if($this->session->userdata('email')): ?>

<?php echo $this->load->view('admin/include/header'); ?>

<div id="content">
	<div id="admin-left">
		<div id='ajax-content'>
			<table id='blog'>
				<caption>
					kurs [<?php echo $total ?> data]
					<div class='insert' style='float:right;text-transform:lowercase;'>
						<a href="<?php echo base_url() ?>admin/kurs/insert">
							<img src="<?php echo base_url() ?>images/insert.gif" alt="Tambah Data">
							Tambah Data
						</a>
					</div>
				</caption>
				<thead>
					<tr>
						<th class='no'>No</th>
						<th>Mata Uang</th>
						<th>Jual</th>
						<th>Beli</th>
						<th>Bendera</th>
						<th class='action'>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $num = 1; ?>
					<?php foreach($kurs as $row): ?>
					<tr>
						<td><?php echo $num ?></td>
						<td><?php echo $row->mata_uang ?></td>
						<td><?php echo str_replace(',','.',number_format($row->jual)) ?></td>
						<td><?php echo str_replace(',','.',number_format($row->beli)) ?></td>
						<td><img src="<?php echo base_url() ?>images/<?php echo $row->bendera; ?>" width="40" height="20" /></td>
						<td>
							<a href="<?php echo base_url() ?>admin/kurs/update_kurs/<?php echo $row->id_kurs ?>">
								<img src="<?php echo base_url() ?>images/update.gif" alt="Edit Data" title="Edit Data">
							</a>
							<a href="<?php echo base_url() ?>admin/kurs/delete_kurs/<?php echo $row->id_kurs ?>" onclick="return confirm('Apakah anda yakin untuk menghapus kurs ini?')">
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
			<legend>Update Kurs</legend>
			<form id='update' action="<?php echo base_url() ?>admin/kurs/update_kurs_y/" method="post" accept-charset="utf-8" enctype='multipart/form-data'>
				<input type="hidden" name="id_kurs" value="<?php echo $this->session->userdata('id_kurs'); ?>">
				<?php foreach($getkurs as $gb): ?>
				<div class="simple">
					<label for="nama">Nama Kurs</label>
					<input type='text' id='mata_uang' name="mata_uang" value="<?php echo $gb->mata_uang ?>" class='required'>
				</div>
				<div class="simple">
					<label for="biaya">Jual</label>
					<input type='text' id='jual' name="jual" value="<?php echo $gb->jual ?>" class='required'>
				</div>
				<div class="simple">
					<label for="biaya">Beli</label>
					<input type='text' id='beli' name="beli" value="<?php echo $gb->beli ?>" class='required'>
				</div>
				<div class="simple">
					<label for="biaya">Bendera</label>
					<input type='text' id='bendera' name="bendera" value="<?php echo $gb->bendera ?>" class='required'>
				</div>
					<?php $this->session->unset_userdata('error'); ?>
				<?php endforeach; ?>
			<?php else: ?>
			<legend>Tambah Kurs</legend>
			<?php echo validation_errors('<div class="error">', '</div>'); ?>
			<form id='insert' action="<?php echo base_url() ?>admin/kurs/insert_kurs/" method="post" enctype="multipart/form-data" accept-charset="utf-8">
				<div class="simple">
					<label for="nama">Mata Uang</label>
					<input type='text' id='mata_uang' name="mata_uang" value="<?php echo set_value('mata_uang') ?>" class='required'>
				</div>
				<div class="simple">
					<label for="biaya">Jual</label>
					<input type='text' id='jual' name="jual" value="<?php echo set_value('jual') ?>" class='required'>
				</div>
				<div class="simple">
					<label for="biaya">Beli</label>
					<input type='text' id='beli' name="beli" value="<?php echo set_value('beli') ?>" class='required'>
				</div>
				<div class="simple">
					<label for="biaya">Bendera</label>
					<input type='text' id='bendera' name="bendera" value="<?php echo set_value('bendera') ?>" class='required'>
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
