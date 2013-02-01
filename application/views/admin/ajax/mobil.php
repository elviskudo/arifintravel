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