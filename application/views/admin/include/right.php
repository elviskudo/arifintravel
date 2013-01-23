<div id="admin-right">
	<h4>Master Data</h4>
	<ul>
		<li><a href="<?php echo base_url() ?>admin/cabang/">KANTOR CABANG</a></li>
		<li><a href="<?php echo base_url() ?>admin/pesawat/">PESAWAT</a></li>
		<li><a href="<?php echo base_url() ?>admin/kota/">KOTA</a></li>
		<li><a href="<?php echo base_url() ?>admin/jam/">JAM</a></li>
		<li><a href="<?php echo base_url() ?>admin/kurs/">KURS</a></li>
		<li><a href="<?php echo base_url() ?>admin/mobil/">MOBIL</a></li>
		<li><a href="<?php echo base_url() ?>admin/user/">USER</a></li>
	</ul>
	<br />
	<br />
	<h4>User yang login:</h4>
	<ul>
		<?php foreach($user as $row): ?>
		<li>
			<p class='nama'>Username:</p>
			<p style='font-weight:bold'><?php echo $this->session->userdata('email'); ?></p>
		</li>
		<li>
			<p class='nama'>Nama:</p>
			<p style='font-weight:bold'><?php echo $row->nama; ?></p>
		</li>
		<li>
			<p class='nama'>Email:</p>
			<p style='font-weight:bold'><?php echo $row->email; ?></p>
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
				echo 'ADMIN';
			else
				echo 'GUEST';
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
