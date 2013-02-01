<?php if($this->session->userdata('email')): ?>

<?php echo $this->load->view('admin/include/header'); ?>

<div id="content">
	<div id="admin-left">
		<div id='ajax-content'>
			<table id='blog'>
				<caption>
					report penjemputan
					<div class='insert' style='display:block;float:right;position:relative;text-transform:lowercase;width:210px;z-index:999;'>
						<form action="<?php echo base_url() ?>admin/invoicej/search" method="post" accept-charset="utf-8" style='float:right;margin:-8px 0'>
							<div style='float:right;'>
								<input type='button' id='search' name='search' value='Filter'>
							</div>
							<div id="filter" style='background:#ccc;border:1px solid #999;display:none;float:right;padding:5px;'>
								<div style="margin:5px;width:640px;">
									<label for="no" style='float:left;margin-top:5px;margin-right:5px;'>no inv</label>
									<input type='text' name="no" value="" style='float:left;margin-right:5px;width:120px'>
									<label for="tanggal_sekian0" style='float:left;margin-top:5px;margin-right:5px;'>tanggal</label>
									<input type='text' name="tanggal_sekian0" value="<?php echo date('d/m/Y') ?>" style='float:left;width:60px;margin-right:5px;' onfocus='if(this.value=="__/__/____")this.value=""' onblur='if(this.value=="")this.value="__/__/____";'>
									<label for="tanggal_sekian1" style='float:left;margin-top:5px;margin-right:5px;'>s/d</label>
									<input type='text' name="tanggal_sekian1" value="<?php echo date('d/m/Y') ?>" style='float:left;width:60px;margin-right:5px;' onfocus='if(this.value=="__/__/____")this.value=""' onblur='if(this.value=="")this.value="__/__/____";'>
									<label for="kota" style='float:left;margin-top:5px;margin-right:5px;'>kota</label>
									<select name="kota" style='float:left;width:60px;margin-right:5px;'>
										<?php $num = 1; ?>
										<?php foreach($kota as $kt): ?>
											<?php if($num == 1): ?>
										<option value="<?php echo $kt->nama ?>" selected><?php echo $kt->nama ?></option>
											<?php else: ?>
										<option value="<?php echo $kt->nama ?>"><?php echo $kt->nama ?></option>
											<?php endif; ?>
											<?php $num++ ?>
										<?php endforeach; ?>
									</select>
									<label for="approve" style='float:left;margin-top:5px;margin-right:5px;'>approve</label>
									<input type='checkbox' id='approve' name="approve" style='float:left;margin-right:5px;' onchange='oncekapp()'>
									<input type="hidden" id='approve_submit' name="approve_submit" value="0">
									<input type="submit" name="submit" value="Go">
								</div>
							</div>
							
						</form>
					</div>
					<div style='clear:both;float:left'>
						<?php if(isset($tanggal_sekian0) || isset($tanggal_sekian1) || isset($kotayangdituju)): ?>
						<span style='margin-top:-2px'>Dari tanggal: <?php echo $tanggal_sekian0 ?> s/d <?php echo $tanggal_sekian1 ?> kota <?php echo $kotayangdituju ?></span>
						<?php endif; ?>
					</div>
				</caption>
				<thead>
					<tr>
						<th class='no'>No</th>
						<th>No Invoice</th>
						<th>Kota Tujuan</th>
						<th>Orang</th>
						<th>Tanggal Jemput</th>
						<th>Jam</th>
						<th>Biaya</th>
						<th>Approve</th>
						<th class='action'>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $num = 1; ?>
					<?php foreach($invoicej as $row): ?>
					<tr>
						<td><?php echo $num ?></td>
						<td><?php echo $row->no ?></td>
						<td><?php echo $row->kota ?></td>
						<td><?php echo $row->orang ?></td>
						<td><?php echo $row->tanggal_jemput ?></td>
						<td><?php echo $row->jam ?></td>
						<td><?php echo number_format($row->biaya,0,',','.') ?></td>
						<td>
							<?php if($row->status == 1): ?>
							<a href="<?php echo base_url() ?>admin/invoicej/update0/<?php echo $row->id_invoicej ?>" class='approve' value="cek" onclick="return confirm('Apakah kamu yakin untuk mengubah status ini?')">Sudah</a>
							<?php else: ?>
							<a href="<?php echo base_url() ?>admin/invoicej/update1/<?php echo $row->id_invoicej ?>" class='approve' value="uncek" onclick="return confirm('Apakah kamu yakin untuk mengubah status ini?')">Belum</a>
							<?php endif; ?>
						</td>
						<td>
							<a href="<?php echo base_url() ?>admin/invoicej/printr/<?php echo $row->no ?>" target='_blank'>
								<img src="<?php echo base_url() ?>images/check.gif" alt="View Data" title="View Data">
							</a>
							<a href="<?php echo base_url() ?>admin/invoicej/update_invoicej/<?php echo $row->id_invoicej ?>">
								<img src="<?php echo base_url() ?>images/update.gif" alt="Edit Data" title="Edit Data">
							</a>
							<a href="<?php echo base_url() ?>admin/invoicej/delete_invoicej/<?php echo $row->id_invoicej ?>" onclick="return confirm('Apakah kamu yakin untuk menghapus invoice ini?')">
								<img src="<?php echo base_url() ?>images/delete.gif" alt="Hapus Data" title="Hapus Data">
							</a>
						</td>
					</tr>
					<?php $num++; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
				<?php if(!$this->session->userdata('searchj')): ?>
			<!--<ul id="pagination-digg" class='ajax-page' style='margin-bottom:40px;'>
				<?php echo $this->pagination->create_links(); ?>
			</ul>-->
				<?php endif; ?>
				<?php $this->session->unset_userdata('searchj'); ?>
				
				<div style='float:right;font-weight:bold'> total biaya: <?php echo number_format($totalbiaya,0,",",".") ?></div>
		</div>
		<div class='clear'></div>
		
		<?php if($this->session->userdata('error')):?>
		<div class='error'><?php echo $this->session->userdata('error'); ?></div>
		<?php endif; ?>
		<fieldset>
			<?php if($this->session->userdata('update') == 'yes'): ?>
			<legend>Update Invoice</legend>
			<form id='update' action="<?php echo base_url() ?>admin/invoicej/update_invoicej_y/" method="post" accept-charset="utf-8" enctype='multipart/form-data'>
				<input type="hidden" name="id_invoicej" value="<?php echo $this->session->userdata('id_invoicej'); ?>">
				<?php foreach($getinvoicej as $gb): ?>
					<?php if($gb->status == 1): ?>
				<input type="hidden" id='cekok' name="cekok" value="1">
					<?php else: ?>
				<input type="hidden" id='cekok' name="cekok" value="0">
					<?php endif; ?>
				<div class="simple">
					<label for="pesawat">No/Nama Pesawat</label>
					<input type='text' id='pesawat' name="pesawat" value="<?php echo $gb->pesawat ?>" class='required'>
				</div>
				<div class="simple">
					<label for="penumpang">Penumpang</label>
					<select id='penumpang' name="penumpang" class='required'>
						<?php foreach($getuser as $kt): ?>
							<?php if($gb->id_user == $kt->id_user): ?>
								<?php $selected = 'selected'; ?>
							<?php else: ?>
								<?php $selected = ''; ?>
							<?php endif; ?>
						<option value="<?php echo $kt->id_user ?>" <?php echo $selected ?>><?php echo $kt->nama ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="simple">
					<label for="kota">Kota Tujuan</label>
					<input type='text' id='kota' name="kota" value="<?php echo $gb->kota; ?>" class='required'>
				</div>
				<div class="simple">
					<label for="tanggal_jemput">Tanggal Jemput</label>
					<input type='text' id='tanggal_jemput' class='date-pick' name="tanggal_jemput" value="<?php echo $gb->tanggal_jemput; ?>" class='required'>
				</div>
				<div class="simple">
					<label for="ktp">KTP</label>
					<input type='text' id='ktp' name="ktp" value="<?php echo $gb->ktp; ?>" readonly>
				</div>
				<div class="simple">
					<label for="jam">Jam</label>
					<input type='text' id='jam' name="jam" value="<?php echo $gb->jam; ?>" class='required'>
				</div>
				<div class="simple">
					<label for="biaya">Biaya</label>
					<input type='text' id='biaya' name="biaya" value="<?php echo $gb->biaya; ?>" readonly class='required'>
				</div>
				<div class="simple">
					<label for="telpon">Telpon</label>
					<input type='text' id='telpon' name="telpon" value="<?php echo $gb->telpon; ?>" readonly>
				</div>
				<div class="simple">
					<label for="cek">Approve</label>
					<?php if($gb->status == 1): ?>
					<input type='checkbox' id='cek' name="cek" checked onchange='oncek()'>
					<?php else: ?>
					<input type='checkbox' id='cek' name="cek" value="<?php echo set_checkbox('cek') ?>" onchange='oncek()'>
					<?php endif; ?>
				</div>
				<div class="simple">
					<label for="catatan">Catatan</label>
					<textarea id='catatan' name="catatan" class='required'>
						<?php echo $gb->catatan; ?>
					</textarea>
				</div>
					<?php $this->session->unset_userdata('error'); ?>
				<?php endforeach; ?>
				<table border="0" cellspacing="5" cellpadding="5">
					<tr>
						<th>Nama</th>
						<th>Alamat</th>
						<th>Telpon</th>
						<th>Action</th>
					</tr>
					<?php foreach($penumpang as $pn): ?>
					<tr>
						<td><div id='nama_<?php echo $pn->id_penumpang ?>' class='nama'><?php echo $pn->nama ?></div></td>
						<td><div id='alamat_<?php echo $pn->id_penumpang ?>' class='alamat'><?php echo $pn->alamat ?></div></td>
						<td><div id='telpon_<?php echo $pn->id_penumpang ?>' class='telpon'><?php echo $pn->telpon ?></div></td>
						<td style='color:#f00'>Click pada item yang akan diedit<br>Selesai edit tekan Enter</td>
					</tr>
					<?php endforeach; ?>
				</table>
				<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-1.6.1.min.js" charset="utf-8"></script>
				<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.jeditable.mini.js" charset="utf-8"></script>
				<script type="text/javascript" charset="utf-8">
					$(document).ready(function() {
						$('.nama').editable('<?php echo base_url() ?>admin/invoicej/update_nama', {
							name : 'nama',
							indicator : 'Simpan...',
							tooltip : 'Klik untuk mengedit',
						});
						$('.alamat').editable('<?php echo base_url() ?>admin/invoicej/update_alamat', {
							name : 'alamat',
							indicator : 'Simpan...',
							tooltip : 'Klik untuk mengedit',
						});
						$('.telpon').editable('<?php echo base_url() ?>admin/invoicej/update_telpon', {
							name : 'telpon',
							indicator : 'Simpan...',
							tooltip : 'Klik untuk mengedit',
						});
					});
				</script>
				<div class="simple">
					<label for='submit'>&nbsp;</label>
					<input type="submit" value="Simpan">
				</div>
			<?php else: ?>
			<!--<legend>Tambah Invoice</legend>
			<?php echo validation_errors('<div class="error">', '</div>'); ?>
			<form id='insert' action="<?php echo base_url() ?>admin/invoicej/insert_invoicej/" method="post" enctype="multipart/form-data" accept-charset="utf-8">
				<input type="hidden" id='cekok' name="cekok" value="0">
				<div class="simple">
					<label for="pesawat">No/Nama Pesawat</label>
					<input type='text' id='pesawat' name="pesawat" value="<?php echo set_value('pesawat') ?>" class='required'>
				</div>
				<div class="simple">
					<label for="penumpang">Penumpang</label>
					<select id='penumpang' name="penumpang" class='required'>
						<?php foreach($getuser as $kt): ?>
						<option value="<?php echo $kt->id_user ?>"><?php echo $kt->nama ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="simple">
					<label for="kota">Kota Tujuan</label>
					<input type='text' id='kota' name="kota" value="<?php echo set_value('kota') ?>" class='required'>
				</div>
				<div class="simple">
					<label for="tanggal_jemput">Tanggal Jemput</label>
					<input type='text' id='tanggal_jemput' class='date-pick' name="tanggal_jemput" value="<?php echo set_value('tanggal_jemput') ?>" class='required'>
				</div>
				<div class="simple">
					<label for="jam">Jam</label>
					<input type='text' id='jam' name="jam" value="<?php echo set_value('jam') ?>" class='required'>
				</div>
				<div class="simple">
					<label for="biaya">Biaya</label>
					<input type='text' id='biaya' name="biaya" value="<?php echo set_value('biaya') ?>" class='required'>
				</div>
				<div class="simple">
					<label for="telpon">Telpon</label>
					<input type='text' id='telpon' name="telpon" value="<?php echo set_value('telpon') ?>" class='required'>
				</div>
				<div class="simple">
					<label for="cek">Approve</label>
					<input type='checkbox' id='cek' name="cek" value="<?php echo set_checkbox('cek') ?>" onchange='oncek()'>
				</div>
				<div class="simple">
					<label for="catatan">Catatan</label>
					<textarea id='catatan' name="catatan"></textarea>
				</div>-->
				<?php endif; ?>
				<script type="text/javascript" charset="utf-8">
					function oncek() {
						if(document.getElementById('cek').checked === true) {
							document.getElementById('cekok').value = '1';
						} else {
							document.getElementById('cekok').value = '0';
						}
					}
				</script>
				<!--<div class="simple">
					<label for='submit'>&nbsp;</label>
					<input type="submit" value="Simpan">
				</div>-->
			</form>
		</fieldset>
		<div class='clear'></div>
	</div><!--#left-->
	
	<script type="text/javascript" charset="utf-8">
		function oncekapp() {
			var approve = document.getElementById('approve');
			var approve_submit = document.getElementById('approve_submit');
			if(approve.checked == true) {
				approve_submit.value = 1;
			} else {
				approve_submit.value = 0;
			}
		}
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
