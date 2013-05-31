			<table id='blog'>
				<caption>
					Pegawai [<?php echo $total ?> data]
					<div class='insert' style='float:right;text-transform:lowercase;'>
						<a href="<?php echo base_url() ?>admin/pegawai/insert/">
							<img src="<?php echo base_url() ?>images/insert.gif" alt="Tambah Data">
							Tambah Data
						</a>
					</div>
				</caption>
				<thead>
					<tr>
						<th class='no'>No</th>
						<th>Tanggal</th>
						<th>Email</th>
						<th>Cabang</th>
						<th>Kota</th>
						<th>Telpon</th>
						<th>HP</th>
						<th class='action'>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $num = 1; ?>
					<?php foreach($pegawai as $row): ?>
					<tr>
						<td><?php echo $num ?></td>
						<td><?php echo date('d M Y', $row->tanggal) ?></td>
						<td><?php echo $row->email ?></td>
						<td><?php echo $row->cabang ?></td>
						<td><?php echo $row->kota ?></td>
						<td><?php echo $row->telpon ?></td>
						<td><?php echo $row->hp ?></td>
						<td>
							<a href="<?php echo base_url() ?>admin/pegawai/update_pegawai/<?php echo $row->id_admin ?>">
								<img src="<?php echo base_url() ?>images/update.gif" alt="Edit Data" title="Edit Data">
							</a>
							<a href="<?php echo base_url() ?>admin/pegawai/delete_pegawai/<?php echo $row->id_admin ?>" onclick="return confirm('Apakah kamu yakin untuk menghapus pegawai ini?')">
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
