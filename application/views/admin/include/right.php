<div id="admin-right">
	<?php if($this->session->userdata('level') == 1): ?>
	<h4>Master Data</h4>
	<ul>
		<li><a href="<?php echo base_url() ?>admin/cabang/">KANTOR CABANG</a></li>
		<li><a href="<?php echo base_url() ?>admin/pesawat/">PESAWAT</a></li>
		<li><a href="<?php echo base_url() ?>admin/kota/">KOTA</a></li>
		<li><a href="<?php echo base_url() ?>admin/jam/">JAM</a></li>
		<li><a href="<?php echo base_url() ?>admin/kurs/">KURS</a></li>
		<li><a href="<?php echo base_url() ?>admin/mobil/">MOBIL</a></li>
		<li><a href="<?php echo base_url() ?>admin/pegawai/">PEGAWAI</a></li>
		<li><a href="<?php echo base_url() ?>admin/user/">USER</a></li>
	</ul>
	<br />
	<br />
	<?php endif ?>
	<h4>User yang login:</h4>
	<ul>
		<?php foreach($user as $row): ?>
		<li>
			<p class='nama'>Email:</p>
			<p style='font-weight:bold'><?php echo $this->session->userdata('email'); ?></p>
		</li>
		<li>
			<p class='nama'>Nama:</p>
			<p style='font-weight:bold'><?php echo $row->nama; ?></p>
		</li>
		<li>
			<p class='nama'>Telpon:</p>
			<p style='font-weight:bold'><?php echo $row->telpon; ?></p>
		</li>
		<li>
			<p class='nama'>HP:</p>
			<p style='font-weight:bold'><?php echo $row->hp; ?></p>
		</li>
		<li>
			<p class='nama'>level:</p>
			<p style='font-weight:bold;text-transform:uppercase'>
			<?php
			if($row->level == 1)
				echo 'SUPER USER';
			else
				echo 'PEGAWAI';
			?>
			</p>
		</li>
		<?php endforeach; ?>
		<li>
			<form action="<?php echo base_url() ?>admin/logout/" method="post" accept-charset="utf-8">
				<input type="submit" value="Logout">
			</form>
		</li>
	</ul>
</div><!--#right-->
