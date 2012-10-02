<?php if($this->session->userdata('email')): ?>

<?php echo $this->load->view('admin/include/header'); ?>

<div id="content">
	<div id="admin-left">
		<div id='ajax-content'>
			<table id='blog'>
				<caption>
					jam [<?php echo $total ?> data]
					<div class='insert' style='display:block;float:right;position:relative;text-transform:lowercase;width:210px;z-index:999;'>
						<form action="<?php echo base_url() ?>admin/jam/search" method="post" accept-charset="utf-8" style='float:right;margin:-8px 0'>
							<div style='float:right;'>
								<input type='button' id='search' name='search' value='Filter'>
							</div>
							<a href="<?php echo base_url() ?>admin/jam/insert/" style='display:block;margin-left:500px;margin-top:5px;'>
								<img src="<?php echo base_url() ?>images/insert.gif" alt="Tambah Data">
								Tambah Data
							</a>
							<div id="filter" style='background:#ccc;border:1px solid #999;display:block;float:right;padding:5px;'>
								<div style="margin:5px;width:640px;">
									<label for="kota" style='float:left;margin-top:5px;margin-right:5px;'>kota</label>
									<select name="kota" style='float:left;width:120px;margin-right:5px;'>
										<?php $num = 1; ?>
										<?php foreach($kota as $kt): ?>
											<?php if($num == 1): ?>
										<option value="<?php echo $kt->id_kota ?>" selected><?php echo $kt->nama ?></option>
											<?php else: ?>
										<option value="<?php echo $kt->id_kota ?>"><?php echo $kt->nama ?></option>
											<?php endif; ?>
											<?php $num++ ?>
										<?php endforeach; ?>
									</select>
									<input type="submit" name="submit" value="Go">
								</div>
							</div>
						</form>
					</div>
				</caption>
				<thead>
					<tr>
						<th class='no'>No</th>
						<th>No Pesawat</th>
						<th>Nama Pesawat</th>
						<th>Jam Pengantaran</th>
						<th>Kota</th>
						<th class='action'>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $num = 1; ?>
					<?php foreach($jam as $row): ?>
					<tr>
						<td><?php echo $num ?></td>
						<td><?php echo $row->no ?></td>
						<td><?php echo $row->nama ?></td>
						<td><?php echo $row->jam ?></td>
						<td><?php echo $row->kota ?></td>
						<td>
							<a href="<?php echo base_url() ?>admin/jam/update_jam/<?php echo $row->id_jam ?>">
								<img src="<?php echo base_url() ?>images/update.gif" alt="Edit Data" title="Edit Data">
							</a>
							<a href="<?php echo base_url() ?>admin/jam/delete_jam/<?php echo $row->id_jam ?>">
								<img src="<?php echo base_url() ?>images/delete.gif" alt="Hapus Data" title="Hapus Data" onclick="return confirm('Apakah kamu yakin untuk menghapus jam ini?')">
							</a>
						</td>
					</tr>
					<?php $num++; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php if(!$this->session->userdata('search')): ?>
			<!--<ul id="pagination-digg" class='ajax-page' style='margin-bottom:40px;'>-->
				<?php //echo $page_link; ?>
			<!--</ul>-->
			<?php endif; ?>
			<?php $this->session->unset_userdata('search'); ?>
		</div>
		<div class='clear'></div>
		
		<?php if($this->session->userdata('error')):?>
		<div class='error'><?php echo $this->session->userdata('error'); ?></div>
		<?php endif; ?>
		<fieldset>
			<?php if($this->session->userdata('update') == 'yes'): ?>
			<legend>Update Jam</legend>
			<form id='update' action="<?php echo base_url() ?>admin/jam/update_jam_y/" method="post" accept-charset="utf-8" enctype='multipart/form-data'>
				<input type="hidden" name="id_jam" value="<?php echo $this->session->userdata('id_jam'); ?>">
				<?php foreach($getjam as $gb): ?>
				<div class="simple">
					<label for="no">No Pesawat</label>
					<select id='no' name="no" class='required'>
						<?php foreach($pesawat as $ps): ?>
							<?php if($gb->id_pesawat == $ps->id_pesawat): ?>
								<?php $selected = 'selected'; ?>
							<?php else: ?>
								<?php $selected = ''; ?>
							<?php endif; ?>
						<option value="<?php echo $ps->id_pesawat ?>" <?php echo $selected ?>><?php echo $ps->no ?> - <?php echo $ps->nama ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="simple">
					<label for="kota">Kota Tujuan</label>
					<select id='kota' name="kota" class='required'>
						<?php foreach($kota as $kt): ?>
							<?php if($gb->id_kota == $kt->id_kota): ?>
								<?php $selected = 'selected'; ?>
							<?php else: ?>
								<?php $selected = ''; ?>
							<?php endif; ?>
						<option value="<?php echo $kt->id_kota ?>" <?php echo $selected ?>><?php echo $kt->nama ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="simple">
					<label for="jam">Jam</label>
					<input type='text' id='jam' name="jam" value="<?php echo $gb->jam ?>" class='required'>
				</div>
					<?php $this->session->unset_userdata('error'); ?>
				<?php endforeach; ?>
			<?php else: ?>
			<legend>Tambah Jam</legend>
			<?php echo validation_errors('<div class="error">', '</div>'); ?>
			<form id='insert' action="<?php echo base_url() ?>admin/jam/insert_jam/" method="post" enctype="multipart/form-data" accept-charset="utf-8">
				<div class="simple">
					<label for="no">No Pesawat</label>
					<select id='no' name="no" class='required'>
						<?php foreach($pesawat as $ps): ?>
						<option value="<?php echo $ps->id_pesawat ?>"><?php echo $ps->no ?> - <?php echo $ps->nama ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="simple">
					<label for="kota">Kota Tujuan</label>
					<select id='kota' name="kota" class='required'>
						<?php foreach($kota as $kt): ?>
						<option value="<?php echo $kt->id_kota ?>"><?php echo $kt->nama ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="simple">
					<label for="jam">Jam</label>
					<input type='text' id='jam' name="jam" value="<?php echo set_value('jam') ?>" class='required'>
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

	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('#search').toggle(function() {
				$('#filter, #filter label').css({display:'block'});
			},function() {
				$('#filter, #filter label').css({display:'none'});
			});
		});
	</script>

<?php echo $this->load->view('admin/include/right'); ?>

</div><!--#content-->
<div class='clear'></div>

<?php echo $this->load->view('admin/include/footer'); ?>

<?php else: ?>

<?php echo $this->load->view('admin/include/login'); ?>

<?php endif; ?>
