			<table id='blog'>
				<caption>
					pesawat [<?php echo $total ?> data]
					<div class='insert' style='float:right;text-transform:lowercase;'>
						<a href="<?php echo base_url() ?>admin/pesawat/insert/">
							<img src="<?php echo base_url() ?>images/insert.gif" alt="Tambah Data">
							Tambah Data
						</a>
					</div>
				</caption>
				<thead>
					<tr>
						<th class='no'>No</th>
						<th>No Pesawat</th>
						<th>Nama</th>
						<th>Jam</th>
						<th class='action'>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $num = 1; ?>
					<?php foreach($pesawat as $row): ?>
					<tr>
						<td><?php echo $num ?></td>
						<td><?php echo $row->no ?></td>
						<td><?php echo $row->nama ?></td>
						<td><?php echo $row->jam ?></td>
						<td>
							<a href="<?php echo base_url() ?>admin/pesawat/update_pesawat/<?php echo $row->id_pesawat ?>">
								<img src="<?php echo base_url() ?>images/update.gif" alt="Edit Data" title="Edit Data">
							</a>
							<a href="<?php echo base_url() ?>admin/pesawat/delete_pesawat/<?php echo $row->id_pesawat ?>" onclick="return confirm('Apakah kamu yakin untuk menghapus pesawat ini?')">
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