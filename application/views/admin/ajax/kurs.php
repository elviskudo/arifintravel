			<table id='blog'>
				<caption>
					kurs [<?php echo $total ?> data]
					<div class='insert' style='float:right;text-transform:lowercase;'>
						<a href="<?php echo base_url() ?>admin/kurs/insert/">
							<img src="<?php echo base_url() ?>images/insert.gif" alt="Tambah Data">
							Tambah Data
						</a>
					</div>
				</caption>
				<thead>
					<tr>
						<th class='no'>No</th>
						<th>Mata Uang</th>
						<th>Jual</th>
						<th>Beli</th>
						<th>Bendera</th>
						<th class='action'>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $num = 1; ?>
					<?php foreach($kurs as $row): ?>
					<tr>
						<td><?php echo $num ?></td>
						<td><?php echo $row->mata_uang ?></td>
						<td><?php echo str_replace(',','.',number_format($row->jual)) ?></td>
						<td><?php echo str_replace(',','.',number_format($row->beli)) ?></td>
						<td><img src="<?php echo base_url() ?>images/<?php echo $row->bendera; ?>" width="40" height="20"/></td>
						<td>
							<a href="<?php echo base_url() ?>admin/kurs/update_kurs/<?php echo $row->id_kurs ?>">
								<img src="<?php echo base_url() ?>images/update.gif" alt="Edit Data" title="Edit Data">
							</a>
							<a href="<?php echo base_url() ?>admin/kurs/delete_kurs/<?php echo $row->id_kurs ?>" onclick="return confirm('Apakah anda yakin untuk menghapus kurs ini?')">
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