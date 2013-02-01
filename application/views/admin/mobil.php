<?php if($this->session->userdata('email')): ?>

<?php echo $this->load->view('admin/include/header'); ?>

<div id="content">
	<div id="admin-left">
		<div id='ajax-content'>
			<table id='blog'>
				<caption>
					mobil [<?php echo $total ?> data]
					<div class='insert' style='float:right;text-transform:lowercase;'>
						<a href="<?php echo base_url() ?>admin/mobil/insert/">
							<img src="<?php echo base_url() ?>images/insert.gif" alt="Tambah Data">
							Tambah Data
						</a>
					</div>
				</caption>
				<thead>
					<tr>
						<th class='no'>No</th>
						<th>Plat Nomor</th>
						<th>Jenis</th>
						<th>Tarif</th>
						<th>Warna</th>
						<th class='action'>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $num = 1; ?>
					<?php foreach($mobil as $row): ?>
					<tr>
						<td><?php echo $num ?></td>
						<td><?php echo $row->plat ?></td>
						<td><?php echo $row->jenis ?></td>
						<td><?php echo str_replace(',','.',number_format($row->tarif)) ?></td>
						<td><?php echo $row->warna ?></td>
						<td>
							<a href="<?php echo base_url() ?>admin/mobil/update_mobil/<?php echo $row->id_mobil ?>">
								<img src="<?php echo base_url() ?>images/update.gif" alt="Edit Data" title="Edit Data">
							</a>
							<a href="<?php echo base_url() ?>admin/mobil/delete_mobil/<?php echo $row->id_mobil ?>" onclick="return confirm('Apakah kamu yakin untuk menghapus mobil ini?')">
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
			<legend>Update mobil</legend>
			<form id='update' action="<?php echo base_url() ?>admin/mobil/update_mobil_y/" method="post" accept-charset="utf-8" enctype='multipart/form-data'>
				<input type="hidden" name="id_mobil" value="<?php echo $this->session->userdata('id_mobil'); ?>">
				<?php foreach($getmobil as $gb): ?>
				<div class="simple">
					<label for="nama">Plat Nomor</label>
					<input type='text' id='plat' name="plat" value="<?php echo $gb->plat ?>" class='required'>
				</div>
				<div class="simple">
					<label for="biaya">Jenis</label>
					<input type='text' id='jenis' name="jenis" value="<?php echo $gb->jenis ?>" class='required'>
				</div>
				<div class="simple">
					<label for="biaya">Tarif</label>
					<input type='text' id='tarif' name="tarif" value="<?php echo $gb->tarif ?>" class='required'>
				</div>
				<div class="simple">
					<label for="biaya">Warna</label>
					<input type='text' id='warna' name="warna" value="<?php echo $gb->warna ?>" class='required'>
				</div>
					<?php $this->session->unset_userdata('error'); ?>
				<?php endforeach; ?>
			<?php else: ?>
			<legend>Tambah mobil</legend>
			<?php echo validation_errors('<div class="error">', '</div>'); ?>
			<form id='insert' action="<?php echo base_url() ?>admin/mobil/insert_mobil/" method="post" enctype="multipart/form-data" accept-charset="utf-8">
				
				<div class="simple">
					<label for="nama">Plat Nomor</label>
					<input type='text' id='plat' name="plat" value="<?php echo set_value('plat') ?>" class='required'>
				</div>
				<div class="simple">
					<label for="biaya">Jenis</label>
					<input type='text' id='jenis' name="jenis" value="<?php echo set_value('jenis') ?>" class='required'>
				</div>
				<div class="simple">
					<label for="biaya">Tarif</label>
					<input type='text' id='tarif' name="tarif" value="<?php echo set_value('tarif') ?>" class='required'>
				</div>
				<div class="simple">
					<label for="biaya">Warna</label>
					<input type='text' id='warna' name="warna" value="<?php echo set_value('warna') ?>" class='required'>
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
