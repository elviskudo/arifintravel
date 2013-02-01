			<table id='blog'>
				<caption>
					kota [<?php echo $total ?> data]
					<div class='insert' style='float:right;text-transform:lowercase;'>
						<a href="<?php echo base_url() ?>admin/kota/insert/">
							<img src="<?php echo base_url() ?>images/insert.gif" alt="Tambah Data">
							Tambah Data
						</a>
					</div>
				</caption>
				<thead>
					<tr>
						<th class='no'>No</th>
						<th>Nama</th>
						<th>Biaya</th>
						<th class='action'>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $num = 1; ?>
					<?php foreach($kota as $row): ?>
					<tr>
						<td><?php echo $num ?></td>
						<td><?php echo $row->nama ?></td>
						<td><?php echo str_replace(',','.',number_format($row->biaya)) ?></td>
						<td>
							<a href="<?php echo base_url() ?>admin/kota/update_kota/<?php echo $row->id_kota ?>">
								<img src="<?php echo base_url() ?>images/update.gif" alt="Edit Data" title="Edit Data">
							</a>
							<a href="<?php echo base_url() ?>admin/kota/delete_kota/<?php echo $row->id_kota ?>" onclick="return confirm('Apakah kamu yakin untuk menghapus kota ini?')">
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