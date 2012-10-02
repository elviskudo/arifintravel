			<table id='blog'>
				<caption>
					jam [<?php echo $total ?> data]
					<div class='insert' style='float:right;text-transform:lowercase;'>
						<a href="<?php echo base_url() ?>admin/jam/insert/">
							<img src="<?php echo base_url() ?>images/insert.gif" alt="Tambah Data">
							Tambah Data
						</a>
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
			<ul id="pagination-digg" class='ajax-page' style='margin-bottom:40px;'>
				<?php echo $this->pagination->create_links(); ?>
			</ul>