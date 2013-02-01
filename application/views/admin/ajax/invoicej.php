			<table id='blog'>
				<caption>
					report penjemputan [<?php echo $total ?> data]
					<div class='insert' style='float:right;text-transform:lowercase;width:210px'>
						<form action="<?php echo base_url() ?>admin/invoicej/search" method="post" accept-charset="utf-8" style='float:right;margin:-8px 0'>
							<div style='float:right;'>
								<input type='button' id='search' name='search' value='Filter'>
							</div>
							<div id="filter" style='background:#ccc;border:1px solid #999;display:none;float:right;padding:5px;'>
								<div style="margin:5px;width:640px;">
									<label for="no" style='float:left;margin-top:5px;margin-right:5px;'>no inv</label>
									<input type='text' name="no" value="" style='float:left;margin-right:5px;width:120px'>
									<label for="tanggal_sekian0" style='float:left;margin-top:5px;margin-right:5px;'>tanggal</label>
									<input type='text' name="tanggal_sekian0" value="__/__/____" style='float:left;width:60px;margin-right:5px;' onfocus='if(this.value=="__/__/____")this.value=""' onblur='if(this.value=="")this.value="__/__/____";'>
									<label for="tanggal_sekian1" style='float:left;margin-top:5px;margin-right:5px;'>s/d</label>
									<input type='text' name="tanggal_sekian1" value="__/__/____" style='float:left;width:60px;margin-right:5px;' onfocus='if(this.value=="__/__/____")this.value=""' onblur='if(this.value=="")this.value="__/__/____";'>
									<label for="kota" style='float:left;margin-top:5px;margin-right:5px;'>kota</label>
									<select name="kota" style='float:left;width:60px;margin-right:5px;'>
										<option value="">---</option>
										<?php foreach($kota as $kt): ?>
										<option value="<?php echo $kt->nama ?>"><?php echo $kt->nama ?></option>
										<?php endforeach; ?>
									</select>
									<label for="approve" style='float:left;margin-top:5px;margin-right:5px;'>approve</label>
									<input type='checkbox' id='approve' name="approve" style='float:left;margin-right:5px;' onchange='oncekapp()'>
									<input type="hidden" id='approve_submit' name="approve_submit" value="0">
									<input type="submit" name="submit" value="Go">
								</div>
							</div>
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
						</form>
					</div>
				</caption>
				<thead>
					<tr>
						<th class='no'>No</th>
						<th>No Invoice</th>
						<th>Tanggal</th>
						<th>User</th>
						<th>Kota Tujuan</th>
						<th>Orang</th>
						<th>Tanggal Jemput</th>
						<th>Jam</th>
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
						<td><?php echo $row->tanggal ?></td>
						<td><?php echo $row->user ?></td>
						<td><?php echo $row->kota ?></td>
						<td><?php echo $row->orang ?></td>
						<td><?php echo $row->tanggal_jemput ?></td>
						<td><?php echo $row->jam ?></td>
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
			<!--<ul id="pagination-digg" class='ajax-page' style='margin-bottom:40px;'>
				<?php echo $this->pagination->create_links(); ?>
			</ul>-->