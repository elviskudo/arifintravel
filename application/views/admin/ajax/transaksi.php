			<table id='blog'>
				<caption>
					transaksi [<?php echo $total ?> data]
					<div class='insert' style='float:right;text-transform:lowercase;'>
						<a href="<?php echo base_url() ?>admin/transaksi/insert/">
							<img src="<?php echo base_url() ?>images/insert.gif" alt="Tambah Data">
							Tambah Data
						</a>
					</div>
				</caption>
				<thead>
					<tr>
						<th class='no'>No</th>
						<th>Tanggal</th>
						<th>Judul</th>
						<th>Cabang</th>
						<th>Nilai</th>
						<th class='action'>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $num = 1; ?>
					<?php foreach($transaksi as $row): ?>
					<tr>
						<td><?php echo $num ?></td>
						<td><?php echo date('d M Y H:i:s', $row->tanggal) ?></td>
						<td><?php echo $row->judul ?></td>
						<td><?php echo $row->nama ?></td>
						<td><?php echo str_replace(',','.',number_format($row->nilai)) ?></td>
						<td>
							<a href="<?php echo base_url() ?>admin/transaksi/delete_transaksi/<?php echo $row->id_transaksi ?>" onclick="return confirm('Apakah kamu yakin untuk menghapus transaksi ini?')">
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