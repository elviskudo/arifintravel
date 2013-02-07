<?php if($this->session->userdata('email')): ?>

<?php echo $this->load->view('admin/include/header'); ?>

<div id="content">
	<div id="admin-left">
		<div id='ajax-content'>
			<table id='blog'>
				<caption>
					cabang [<?php echo $total ?> data]
					<div class='insert' style='float:right;text-transform:lowercase;'>
						<a href="<?php echo base_url() ?>admin/cabang/insert/">
							<img src="<?php echo base_url() ?>images/insert.gif" alt="Tambah Data">
							Tambah Data
						</a>
					</div>
				</caption>
				<thead>
					<tr>
						<th class='no'>No</th>
						<th>Nama</th>
						<th>Kota</th>
						<th>Telpon</th>
						<th>HP</th>
						<th>Saldo</th>
						<th class='action'>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $num = 1; ?>
					<?php foreach($cabang as $row): ?>
					<tr>
						<td><?php echo $num ?></td>
						<td><?php echo $row->nama ?></td>
						<td><?php echo $row->kota ?></td>
						<td><?php echo $row->telpon ?></td>
						<td><?php echo $row->hp ?></td>
						<td><?php echo str_replace(',','.',number_format($row->saldo_akhir)) ?></td>
						<td>
							<a href="<?php echo base_url() ?>admin/cabang/update_cabang/<?php echo $row->id_cabang ?>">
								<img src="<?php echo base_url() ?>images/update.gif" alt="Edit Data" title="Edit Data">
							</a>
							<?php if($row->id_cabang > 1): ?>
							<a href="<?php echo base_url() ?>admin/cabang/delete_cabang/<?php echo $row->id_cabang ?>" onclick="return confirm('Apakah kamu yakin untuk menghapus cabang ini?')">
								<img src="<?php echo base_url() ?>images/delete.gif" alt="Hapus Data" title="Hapus Data">
							</a>
							<?php endif ?>
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
			<legend>Update cabang</legend>
			<form id='update' action="<?php echo base_url() ?>admin/cabang/update_cabang_y/" method="post" accept-charset="utf-8" enctype='multipart/form-data'>
				<input type="hidden" name="id_cabang" value="<?php echo $this->session->userdata('id_cabang'); ?>">
				<?php foreach($getcabang as $gb): ?>
				<div class="simple">
					<label for="nama">Nama</label>
					<input type='text' id='nama' name="nama" value="<?php echo $gb->nama ?>" class='required'>
				</div>
				<div class="simple">
					<label for="alamat">Alamat</label>
					<input type='text' id='alamat' name="alamat" value="<?php echo $gb->alamat ?>" class='required'>
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
					<label for="email">Email</label>
					<input type='text' id='email' name="email" value="<?php echo $gb->email ?>" class='required'>
				</div>
				<div class="simple">
					<label for="kontak">Kontak</label>
					<input type='text' id='kontak' name="kontak" value="<?php echo $gb->kontak ?>" class='required'>
				</div>
				<div class="simple">
					<label for="hp">HP</label>
					<input type='text' id='hp' name="hp" value="<?php echo $gb->hp ?>" class='required'>
				</div>
				<div class="simple">
					<label for="saldo_awal">Saldo Awal</label>
					<input type='text' id='saldo_awal' name="saldo_awal" value="<?php echo $gb->saldo_awal ?>" class='required'>
				</div>
				<div class="simple">
					<label for="saldo_akhir">Saldo Akhir</label>
					<input type='text' id='saldo_akhir' name="saldo_akhir" value="<?php echo $gb->saldo_akhir ?>" class='required'>
				</div>
					<?php $this->session->unset_userdata('error'); ?>
				<?php endforeach; ?>
			<?php else: ?>
			<legend>Tambah cabang</legend>
			<?php echo validation_errors('<div class="error">', '</div>'); ?>
			<form id='insert' action="<?php echo base_url() ?>admin/cabang/insert_cabang/" method="post" enctype="multipart/form-data" accept-charset="utf-8">
				<div class="simple">
					<label for="nama">Nama</label>
					<input type='text' id='nama' name="nama" value="<?php echo set_value('nama') ?>" class='required'>
				</div>
				<div class="simple">
					<label for="alamat">Alamat</label>
					<input type='text' id='alamat' name="alamat" value="<?php echo set_value('alamat') ?>">
				</div>
				<div class="simple">
					<label for="kota">Kota</label>
					<input type='text' id='kota' name="kota" value="<?php echo set_value('kota') ?>" class='required'>
				</div>
				<div class="simple">
					<label for="telpon">Telpon</label>
					<input type='text' id='telpon' name="telpon" value="<?php echo set_value('telpon') ?>">
				</div>
				<div class="simple">
					<label for="email">Email</label>
					<input type='text' id='email' name="email" value="<?php echo set_value('email') ?>">
				</div>
				<div class="simple">
					<label for="kontak">Kontak</label>
					<input type='text' id='kontak' name="kontak" value="<?php echo set_value('kontak') ?>" class='required'>
				</div>
				<div class="simple">
					<label for="hp">HP</label>
					<input type='text' id='hp' name="hp" value="<?php echo set_value('hp') ?>">
				</div>
				<div class="simple">
					<label for="saldo">Saldo Awal</label>
					<input type='text' id='saldo' name="saldo" value="<?php echo set_value('saldo') ?>" class='required'>
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
