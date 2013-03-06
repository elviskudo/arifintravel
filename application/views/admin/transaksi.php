<?php if($this->session->userdata('email')): ?>

<?php echo $this->load->view('admin/include/header'); ?>

<div id="content">
	<div id="admin-left">
		<div id='ajax-content'>
			<table id='blog'>
				<caption>
					transaksi [<?php echo $total ?> data]
					<font style="color:#090">[ KAS MASUK: <?php echo str_replace(',','.',number_format($kasmasuk)) ?> ]</font>
					<font style="color:#f60">[ KAS KELUAR: <?php echo str_replace(',','.',number_format($kaskeluar)) ?> ]</font>
					<div class='insert' style='display:block;float:right;position:relative;text-transform:lowercase;width:210px;z-index:999;'>
						<form action="<?php echo base_url() ?>admin/transaksi/search" method="post" accept-charset="utf-8" style='float:right;margin:-8px 0'>
							<div style='float:right;'>
								<input type='button' id='search' name='search' value='Filter'>
							</div>
							<a href="<?php echo base_url() ?>admin/transaksi/insert/" style='display:block;margin-left:520px;margin-top:5px;'>
								<img src="<?php echo base_url() ?>images/insert.gif" alt="Tambah Kas">
								Tambah Kas
							</a>
							<div id="filter" style='background:#ccc;border:1px solid #999;display:block;float:right;padding:5px;'>
								<div style="margin:5px;width:640px;">
									<label for="kota" style='float:left;margin-top:5px;margin-right:5px;'>Cabang</label>
									<?php if($this->session->userdata('email') == 'admin@arifintravel.com'): ?>
									<select id="kota" name="kota" style='float:left;width:120px;margin-right:5px;'>
										<?php if($this->session->userdata('email') == 'admin@arifintravel.com'): ?>
										<option value="0">SEMUA</option>
										<?php endif ?>
										<?php foreach($cabangs as $cb): ?>
										<option value="<?php echo $cb->id_cabang ?>"><?php echo $cb->nama ?></option>
										<?php endforeach; ?>
									</select>
									<?php else: ?>
									<?php $kota = $this->db->where('id_cabang', $this->session->userdata('id_cabang'))->get('cabang')->row()->nama ?>
									<input type="text" name="kota" value="<?php echo $kota ?>" style="float:left;width:80px;margin-right:10px" readonly />
									<?php endif ?>
									<label for="tanggal_sekian0" style='float:left;margin-top:5px;margin-right:5px;'>tanggal</label>
									<input type='text' id="tanggal0" name="tanggal_sekian0" value="<?php echo date("d/m/Y") ?>" style='float:left;width:70px;margin-right:5px;'>
									
									<img src="<?php echo base_url() ?>images/ew_calendar.gif" id="cx_tanggal0" alt="Pick a Date" style="cursor:pointer;cursor:hand;float:left;margin-top:5px;margin-right:5px;"> 
									<script type="text/javascript">
									Calendar.setup({
										inputField : "tanggal0", // ID of the input field
										ifFormat : "%d/%m/%Y", // the date format
										button : "cx_tanggal0" // ID of the button
									});
									</script>									
									<label for="tanggal_sekian1" style='float:left;margin-top:5px;margin-right:5px;'>s/d</label>
									<input type='text' id='tanggal1' name="tanggal_sekian1" value="<?php echo date('d/m/Y') ?>" style='float:left;width:70px;margin-right:5px;'>
									
									<img src="<?php echo base_url() ?>images/ew_calendar.gif" id="cx_tanggal1" alt="Pick a Date" style="cursor:pointer;cursor:hand;float:left;margin-top:5px;margin-right:5px;"> 
									<script type="text/javascript">
									Calendar.setup({
										inputField : "tanggal1", // ID of the input field
										ifFormat : "%d/%m/%Y", // the date format
										button : "cx_tanggal1" // ID of the button
									});
									</script>

									<input type="submit" name="submit" value="Go" style="float:left">
								</div>
							</div>
						</form>
					</div>
				</caption>
				<thead>
					<tr>
						<th class='no'>No</th>
						<th>Tanggal</th>
						<th>Judul</th>
						<th>Cabang</th>
						<th>Arus</th>
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
						<td><?php echo $row->kota ?></td>
						<td><?php echo $row->arus ?></td>
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
					<?php if($this->session->userdata('id_cabang') == '1'): ?>
						<?php $cabang = $this->cabang_model->all() ?>
					<select name="id_cabang">
						<?php foreach($cabang as $cb): ?>
						<option value="<?php echo $cb->id_cabang ?>"><?php echo $cb->nama ?></option>
						<?php endforeach ?>
					</select>
					<?php else: ?>
					<input type="hidden" name="id_cabang" value="<?php echo $this->session->userdata('id_cabang') ?>">
					<input type="text" id="cabang" name="cabang" value="<?php echo $cabang ?>" readonly />
					<?php endif ?>
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

			<legend>Tambah transaksi <?php echo $kas = ($this->session->userdata('email') != 'admin@arifintravel.com') ? '[ KAS KELUAR ]' : '' ?></legend>
			<?php echo validation_errors('<div class="error">', '</div>'); ?>
			<form id='insert' action="<?php echo base_url() ?>admin/transaksi/insert_transaksi/" method="post" enctype="multipart/form-data" accept-charset="utf-8">
				<div class="simple">
					<label for="id_cabang">Kantor Cabang</label>
					<?php if($this->session->userdata('email') == 'admin@arifintravel.com'): ?>
						<?php $cabang = $this->db->order_by('nama')->get('cabang')->result() ?>
					<select name="id_cabang">
						<?php foreach($cabang as $cb): ?>
						<option value="<?php echo $cb->id_cabang ?>"><?php echo $cb->nama ?></option>
						<?php endforeach ?>
					</select>
					<?php else: ?>
					<input type="hidden" name="id_cabang" value="<?php echo $this->session->userdata('id_cabang') ?>"/>
					<input type="text" id="cabang" name="cabang" value="<?php echo $cabang ?>" readonly>
					<?php endif ?>
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
				<?php if($this->session->userdata('email') == 'admin@arifintravel.com'): ?>
				<div class="simple">
					<label for="nilai">Nilai</label>
					<select id='kas' name="kas" class='required'>
						<option value="masuk">Masuk</option>
						<option value="keluar" selected>Keluar</option>
					</select>
				</div>
				<?php endif ?>

				<?php endif; // session update yes atau no ?>
				<div class="simple">
					<label for='submit'>&nbsp;</label>
					<?php if($this->session->userdata('email') != 'admin@arifintravel.com'): ?>
					<input type="hidden" name="kas" value="keluar" />
					<?php endif ?>
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
