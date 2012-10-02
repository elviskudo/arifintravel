<?php if($this->session->userdata('email')): ?>

<?php echo $this->load->view('admin/include/header'); ?>

<div id="content">
	<div id="admin-left">
		<div class="box">
			<img src="<?php echo base_url() ?>images/profil.jpg" alt=""><br>
			<a href="<?php echo base_url() ?>admin/penumpang/">penumpang</a>
		</div>
		<div class="box">
			<img src="<?php echo base_url() ?>images/program.jpg" alt=""><br>
			<a href="<?php echo base_url() ?>admin/pesawat/">pesawat</a>
		</div>
		<div class="box">
			<img src="<?php echo base_url() ?>images/tamu.jpg" alt=""><br>
			<a href="<?php echo base_url() ?>admin/kota/">kota</a>
		</div>
		<div class="box">
			<img src="<?php echo base_url() ?>images/produk.jpg" alt=""><br>
			<a href="<?php echo base_url() ?>admin/jam/">jam</a>
		</div>
		<div class="box">
			<img src="<?php echo base_url() ?>images/berita.jpg" alt=""><br>
			<a href="<?php echo base_url() ?>admin/invoice/">invoice antar</a>
		</div>
		<div class="box">
			<img src="<?php echo base_url() ?>images/berita.jpg" alt=""><br>
			<a href="<?php echo base_url() ?>admin/invoicej/">invoice jemput</a>
		</div>
		<div class='clear'></div>
		
		<table border="0" cellspacing="5" cellpadding="5">
			<caption>Status Pengantaran [10 data terakhir]</caption>
			<tr>
				<th>No Invoice</th>
				<th>Tanggal</th>
				<th>Nama Pemesan</th>
				<th>Tanggal Antar</th>
				<th>Dari Kota</th>
				<th>Approve</th>
				<th>Action</th>
			</tr>
			<?php foreach($statusantar as $row): ?>
			<tr>
				<td><?php echo $row->no ?></td>
				<td><?php echo $row->tanggal ?></td>
				<td><?php echo $row->nama ?></td>
				<td><?php echo $row->tanggal_antar ?></td>
				<td><?php echo $row->tujuan ?></td>
				<td>
					<?php if($row->status == 1): ?>
					<a href="<?php echo base_url() ?>admin/main/update0/<?php echo $row->id_invoice ?>" class='approve' value="cek" onclick="return confirm('Apakah kamu yakin untuk mengubah status ini?')">Sudah</a>
					<?php else: ?>
					<a href="<?php echo base_url() ?>admin/main/update1/<?php echo $row->id_invoice ?>" class='approve' value="uncek" onclick="return confirm('Apakah kamu yakin untuk mengubah status ini?')">Belum</a>
					<?php endif; ?>
				</td>
				<td>
					<a href="<?php echo base_url() ?>admin/invoice/printr/<?php echo $row->no ?>" target='_blank'>
						<img src="<?php echo base_url() ?>images/check.gif" alt="View Data" title="View Data">
					</a>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
		
		<table border="0" cellspacing="5" cellpadding="5">
			<caption>Status Penjemputan [10 data terakhir]</caption>
			<tr>
				<th>No Invoice</th>
				<th>Tanggal</th>
				<th>Nama Pemesan</th>
				<th>Tanggal Jemput</th>
				<th>Ke Kota</th>
				<th>Approve</th>
				<th>Action</th>
			</tr>
			<?php foreach($statusjemput as $row): ?>
			<tr>
				<td><?php echo $row->no ?></td>
				<td><?php echo $row->tanggal ?></td>
				<td><?php echo $row->nama ?></td>
				<td><?php echo $row->tanggal_jemput ?></td>
				<td><?php echo $row->tujuan ?></td>
				<td>
					<?php if($row->status == 1): ?>
					<a href="<?php echo base_url() ?>admin/main/updatej0/<?php echo $row->id_invoicej ?>" class='approve' value="cek" onclick="return confirm('Apakah kamu yakin untuk mengubah status ini?')">Sudah</a>
					<?php else: ?>
					<a href="<?php echo base_url() ?>admin/main/updatej1/<?php echo $row->id_invoicej ?>" class='approve' value="uncek" onclick="return confirm('Apakah kamu yakin untuk mengubah status ini?')">Belum</a>
					<?php endif; ?>
				</td>
				<td>
					<a href="<?php echo base_url() ?>admin/invoicej/printr/<?php echo $row->no ?>" target='_blank'>
						<img src="<?php echo base_url() ?>images/check.gif" alt="View Data" title="View Data">
					</a>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div><!--#left-->

<?php echo $this->load->view('admin/include/right'); ?>

</div><!--#content-->
<div class='clear'></div>

<?php echo $this->load->view('admin/include/footer'); ?>

<?php else: ?>

<?php echo $this->load->view('admin/include/login'); ?>

<?php endif; ?>
