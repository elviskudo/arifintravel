<?php if($this->session->userdata('email')): ?>

<?php echo $this->load->view('admin/include/header'); ?>

<div id="content">
	<div id="admin-left">
		<div id='ajax-content'>
			<table id='blog'>
				<caption>
					transaksi [<?php echo $total ?> data]
					<div class='insert' style='float:right;text-transform:lowercase;'>
						<a href="<?php echo base_url() ?>admin/transaksi/insert/">
							<img src="<?php echo base_url() ?>images/insert.gif" alt="Tambah Data">
							Tambah Data
						</a>
					</div>
				</caption>
				<thead>
					<tr>
						<th class='no'>No</th>
						<th>Tanggal</th>
						<th>Judul</th>
						<th>Cabang</th>
						<th>Nilai</th>
						<th class='action'>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $num = 1; ?>
					<?php foreach($transaksi as $row): ?>
					<tr>
						<td><?php echo $num ?></td>
						<td><?php echo date('d M Y H:i:s', $row->tanggal) ?></td>
						<td><?php echo $row->judul ?></td>
						<td><?php echo $row->nama ?></td>
						<td><?php echo str_replace(',','.',number_format($row->nilai)) ?></td>
						<td>
							<a href="<?php echo base_url() ?>admin/transaksi/delete_transaksi/<?php echo $row->id_transaksi ?>" onclick="return confirm('Apakah kamu yakin untuk menghapus transaksi ini?')">
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
			<legend>Update transaksi</legend>
			<form id='update' action="<?php echo base_url() ?>admin/transaksi/update_transaksi_y/" method="post" accept-charset="utf-8" enctype='multipart/form-data'>
				<input type="hidden" name="id_transaksi" value="<?php echo $this->session->userdata('id_transaksi'); ?>">
				<?php foreach($gettransaksi as $gb): ?>
				<div class="simple">
					<label for="id_cabang">Kantor Cabang</label>
					<input type="hidden" name="id_cabang" value="<?php echo $this->session->userdata('id_cabang') ?>">
					<input type="text" id="cabang" name="cabang" value="<?php echo $cabang ?>" readonly />
				</div>
				<div class="simple">
					<label for="judul">Judul</label>
					<input type='text' id='judul' name="judul" value="<?php echo $gb->judul ?>" class='required'>
				</div>
				<div class="simple">
					<label for="keterangan">Keterangan</label>
					<textarea id='keterangan' name="keterangan" class='required'><?php echo $gb->keterangan ?></textarea>
				</div>
				<div class="simple">
					<label for="nilai">Nilai</label>
					<input type='text' id='nilai' name="nilai" value="<?php echo $gb->nilai ?>" class='required'>
				</div>
					<?php $this->session->unset_userdata('error'); ?>
				<?php endforeach; ?>
			<?php else: ?>

			<legend>Tambah transaksi</legend>
			<?php echo validation_errors('<div class="error">', '</div>'); ?>
			<form id='insert' action="<?php echo base_url() ?>admin/transaksi/insert_transaksi/" method="post" enctype="multipart/form-data" accept-charset="utf-8">
				<div class="simple">
					<label for="id_cabang">Kantor Cabang</label>
					<input type="hidden" name="id_cabang" value="<?php echo $this->session->userdata('id_cabang') ?>"/>
					<input type="text" id="cabang" name="cabang" value="<?php echo $cabang ?>" readonly>
				</div>
				<div class="simple">
					<label for="judul">Judul</label>
					<input type='text' id='judul' name="judul" value="<?php echo set_value('judul') ?>" class='required'>
				</div>
				<div class="simple">
					<label for="keterangan">Keterangan</label>
					<textarea id='keterangan' name="keterangan" class='required'><?php echo set_value('keterangan') ?></textarea>
				</div>
				<div class="simple">
					<label for="nilai">Nilai</label>
					<input type='text' id='nilai' name="nilai" value="<?php echo set_value('nilai') ?>" class='required'>
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
