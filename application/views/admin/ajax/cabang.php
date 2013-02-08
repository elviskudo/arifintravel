			<table id='blog'>
				<caption>
					cabang [<?php echo $total ?> data]
					<div class='insert' style='float:right;text-transform:lowercase;'>
						<a href="<?php echo base_url() ?>admin/cabang/insert/">
							<img src="<?php echo base_url() ?>images/insert.gif" alt="Tambah Data">
							Tambah Data
						</a>
					</div>
				</caption>
				<thead>
					<tr>
						<th class='no'>No</th>
						<th>Nama</th>
						<th>Kota</th>
						<th>Telpon</th>
						<th>Email</th>
						<th>HP</th>
						<th>Saldo</th>
						<th class='action'>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $num = 1; ?>
					<?php foreach($cabang as $row): ?>
					<tr>
						<td><?php echo $num ?></td>
						<td><?php echo $row->nama ?></td>
						<td><?php echo $row->kota ?></td>
						<td><?php echo $row->telpon ?></td>
						<td><?php echo $row->email ?></td>
						<td><?php echo $row->hp ?></td>
						<td><?php echo str_replace(',','.',number_format($row->saldo_akhir)) ?></td>
						<td>
							<a href="<?php echo base_url() ?>admin/cabang/update_cabang/<?php echo $row->id_cabang ?>">
								<img src="<?php echo base_url() ?>images/update.gif" alt="Edit Data" title="Edit Data">
							</a>
							<?php if($row->id_cabang > 1): ?>
							<a href="<?php echo base_url() ?>admin/cabang/delete_cabang/<?php echo $row->id_cabang ?>" onclick="return confirm('Apakah kamu yakin untuk menghapus cabang ini?')">
								<img src="<?php echo base_url() ?>images/delete.gif" alt="Hapus Data" title="Hapus Data">
							</a>
							<?php endif ?>
						</td>
					</tr>
					<?php $num++; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
			<ul id="pagination-digg" class='ajax-page' style='margin-bottom:40px;'>
				<?php echo $this->pagination->create_links(); ?>
			</ul>