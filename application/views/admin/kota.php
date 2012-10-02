<?php if($this->session->userdata('email')): ?>

<?php echo $this->load->view('admin/include/header'); ?>

<div id="content">
	<div id="admin-left">
		<div id='ajax-content'>
			<table id='blog'>
				<caption>
					kota [<?php echo $total ?> data]
					<div class='insert' style='float:right;text-transform:lowercase;'>
						<a href="<?php echo base_url() ?>admin/kota/insert/">
							<img src="<?php echo base_url() ?>images/insert.gif" alt="Tambah Data">
							Tambah Data
						</a>
					</div>
				</caption>
				<thead>
					<tr>
						<th class='no'>No</th>
						<th>Nama</th>
						<th>Biaya</th>
						<th class='action'>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $num = 1; ?>
					<?php foreach($kota as $row): ?>
					<tr>
						<td><?php echo $num ?></td>
						<td><?php echo $row->nama ?></td>
						<td><?php echo str_replace(',','.',number_format($row->biaya)) ?></td>
						<td>
							<a href="<?php echo base_url() ?>admin/kota/update_kota/<?php echo $row->id_kota ?>">
								<img src="<?php echo base_url() ?>images/update.gif" alt="Edit Data" title="Edit Data">
							</a>
							<a href="<?php echo base_url() ?>admin/kota/delete_kota/<?php echo $row->id_kota ?>" onclick="return confirm('Apakah kamu yakin untuk menghapus kota ini?')">
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
			<legend>Update Kota</legend>
			<form id='update' action="<?php echo base_url() ?>admin/kota/update_kota_y/" method="post" accept-charset="utf-8" enctype='multipart/form-data'>
				<input type="hidden" name="id_kota" value="<?php echo $this->session->userdata('id_kota'); ?>">
				<?php foreach($getkota as $gb): ?>
				<div class="simple">
					<label for="nama">Nama Kota</label>
					<input type='text' id='nama' name="nama" value="<?php echo $gb->nama ?>" class='required'>
				</div>
				<div class="simple">
					<label for="biaya">Biaya</label>
					<input type='text' id='biaya' name="biaya" value="<?php echo $gb->biaya ?>" class='required'>
				</div>
					<?php $this->session->unset_userdata('error'); ?>
				<?php endforeach; ?>
			<?php else: ?>
			<legend>Tambah Kota</legend>
			<?php echo validation_errors('<div class="error">', '</div>'); ?>
			<form id='insert' action="<?php echo base_url() ?>admin/kota/insert_kota/" method="post" enctype="multipart/form-data" accept-charset="utf-8">
				<div class="simple">
					<label for="nama">Nama Kota</label>
					<input type='text' id='nama' name="nama" value="<?php echo set_value('nama') ?>" class='required'>
				</div>
				<div class="simple">
					<label for="biaya">Biaya</label>
					<input type='text' id='biaya' name="biaya" value="<?php echo set_value('biaya') ?>" class='required'>
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
