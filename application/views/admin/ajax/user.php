			<table id='user'>
				<caption>
					manajemen user [<?php echo $total ?> data]
					<div class='insert' style='float:right;text-transform:lowercase;'>
						<a href="<?php echo base_url() ?>admin/user/insert/">
							<img src="<?php echo base_url() ?>images/insert.gif" alt="Tambah Data">
							Tambah Data
						</a>
					</div>
				</caption>
				<thead>
					<tr>
						<th class='no'>No</th>
						<th>Id</th>
						<th>Nama</th>
						<th>Email</th>
						<th>HP</th>
						<th>Level</th>
						<th class='action'>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if($alluser): ?>
						<?php $num = 1; ?>
					<?php foreach($alluser as $row): ?>
						<?php if($num % 2 == 0): ?>
					<tr class='even'>
						<?php else: ?>
					<tr>
						<?php endif; ?>
						<td><?php echo $num ?></td>
						<td><?php echo $row->id_user ?></td>
						<td><?php echo $row->nama ?></td>
						<td><?php echo $row->email ?></td>
						<td><?php echo $row->hp ?></td>
						<td>
							<?php if($row->level == 1): ?>
							Admin
							<?php else: ?>
							Guest
							<?php endif; ?>
						</td>
						<td>
							<a href="<?php echo base_url() ?>admin/user/change_admin/<?php echo $row->id_user ?>" onclick="return confirm('Apakah kamu yakin untuk menset pengguna ini berstatus admin?')">
								<img src="<?php echo base_url() ?>images/set.gif" alt="Default Admin" title="Default Admin">
							</a>
							<a href="<?php echo base_url() ?>admin/user/update_user/<?php echo $row->id_user ?>">
								<img src="<?php echo base_url() ?>images/update.gif" alt="Edit Data" title="Edit Data">
							</a>
							<a href="<?php echo base_url() ?>admin/user/delete_user/<?php echo $row->id_user ?>" onclick="return confirm('Apakah kamu yakin untuk menghapus pengguna ini?')">
								<img src="<?php echo base_url() ?>images/delete.gif" alt="Hapus Data" title="Hapus Data">
							</a>
						</td>
					</tr>
					<?php $num++; ?>
					<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
			<ul id="pagination-digg" class='ajax-page' style='margin-bottom:40px;'>
				<?php echo $this->pagination->create_links(); ?>
			</ul>