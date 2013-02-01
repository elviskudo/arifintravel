<?php echo $this->load->view('include/header'); ?>

	<?php echo $this->load->view('include/menu'); ?>
	
		<div id="histori">
			<table border="0" cellspacing="5" cellpadding="5">
				<caption>Histori Pengantaran</caption>
				<tr>
					<th>No Invoice</th>
					<th>Tanggal</th>
					<th>Tanggal Pengantaran</th>
					<th>Pengikut</th>
					<th>Jam</th>
					<th>Dari Kota</th>
					<th>Action</th>
				</tr>
				<?php foreach($histori as $hs): ?>
				<tr>
					<td><?php echo $hs->no ?></td>
					<td><?php echo $hs->tanggal ?></td>
					<td><?php echo $hs->tanggal_antar ?></td>
					<td><?php echo $hs->orang - 1; ?></td>
					<td><?php echo $hs->jam ?></td>
					<td><?php echo $hs->tujuan ?></td>
					<td>
						<a href="<?php echo base_url() ?>invoice/printr/<?php echo $hs->no ?>" target='_blank'>
							<img src="<?php echo base_url() ?>images/check.gif" alt="">
						</a>
						<a href="<?php echo base_url() ?>daftar/delete/<?php echo $hs->no ?>">
							<img src="<?php echo base_url() ?>images/delete.gif" alt="">
						</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
			<div class='clear'></div>
		
			<table border="0" cellspacing="5" cellpadding="5">
				<caption>Histori Penjemputan</caption>
				<tr>
					<th>No Invoice</th>
					<th>Tanggal</th>
					<th>Tanggal Penjemputan</th>
					<th>Pengikut</th>
					<th>Jam</th>
					<th>Dari Kota</th>
					<th>Action</th>
				</tr>
				<?php foreach($historij as $hs): ?>
				<tr>
					<td><?php echo $hs->no ?></td>
					<td><?php echo $hs->tanggal ?></td>
					<td><?php echo $hs->tanggal_jemput ?></td>
					<td><?php echo $hs->orang - 1; ?></td>
					<td><?php echo $hs->jam ?></td>
					<td><?php echo $hs->tujuan ?></td>
					<td>
						<a href="<?php echo base_url() ?>invoicej/printr/<?php echo $hs->no ?>" target='_blank'>
							<img src="<?php echo base_url() ?>images/check.gif" alt="">
						</a>
						<a href="<?php echo base_url() ?>daftar/deletej/<?php echo $hs->no ?>">
							<img src="<?php echo base_url() ?>images/delete.gif" alt="">
						</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>

	</div><!--#content-->

<?php echo $this->load->view('include/footer'); ?>