<?php echo $this->load->view('include/header'); ?>

	<?php echo $this->load->view('include/menu'); ?>
	
		<div id="middleantar">
			<div id="antar">
				<form id='formAntar' action="<?php echo base_url() ?>login/process" method="post">
					<input type="hidden" name="kota" value="<?php echo $this->input->post('kota'); ?>">
					<input type="hidden" name="orang" value="<?php echo $this->input->post('orang'); ?>">
					<?php if($this->input->post('login_type') == 'jemput'): ?>
					<input type="hidden" name="login_type" value="<?php echo $this->input->post('login_type'); ?>">
					<input type="hidden" name="jam" value="<?php echo $this->input->post('jam'); ?>">
					<?php else: ?>
					<input type="hidden" name="id_kota" value="<?php echo $this->input->post('id_kota'); ?>">
					<input type="hidden" name="jam" value="<?php echo $jam; ?>">
					<input type="hidden" name="pesawat" value="<?php echo $pesawat ?>">
					<?php endif; ?>
					<input type="hidden" name="waktu" value="<?php echo $this->input->post('waktu'); ?>">
					<input type="hidden" name="url" value="yes">
					
					<?php if($this->session->userdata('error_login')): ?>
					<div class='error'><?php echo $this->session->userdata('error_login'); ?></div>
					<?php endif; ?>
					
					<fieldset>
						<legend>Login</legend>
						<div class='simple'>
							<label for="email">Email</label>
							<input type="text" name="email" value="">
						</div>
						<div class='simple'>
							<label for="password">Password</label>
							<input type="password" name="password" value="">
						</div>
						<div class='simple'>
							<label for="daftar">&nbsp;</label>
							<a href="<?php echo base_url() ?>daftar">Daftar</a>
						</div>
						<div class='simple'>
							<label for="submit">&nbsp;</label>
							<input type="submit" name="submit" value="Kirim">
						</div>
					</fieldset>
				</form>
			</div>
		</div><!--#middle-->
		
	</div><!--#content-->

<?php echo $this->load->view('include/footer'); ?>