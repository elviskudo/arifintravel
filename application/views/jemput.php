<?php echo $this->load->view('include/header'); ?>

	<?php echo $this->load->view('include/menu'); ?>
	
		<div id="middleantar">
			<div id="antar">
				<form id='formAntar' action="<?php echo base_url() ?>jemput/insert" method="post">
					<input type="hidden" id='jasaok' name="jasaok" value="0">
					<fieldset>
						<legend>Form Aplikasi Jasa Penjemputan</legend>
						<div class='simple'>
							<label for="pesawat">Nama/No. Pesawat</label>
							<div style='overflow:hidden;margin-left:120px'>
								<input type='text' id='pesawat' name="pesawat" value='' class='required'><br>
								<span style='font-style:italic;color:#f00;'>mis: Air Asia - QZ7690</span>
							</div>
						</div>
						<div class='simple'>
							<label for="kota">Ke Kota Tujuan</label>
							<input type="text" name="kota" value="<?php echo $kota; ?>" readonly>
							<input type="hidden" name="id_kota" value="<?php echo $id_kota ?>" />
						</div>
						<div class='simple'>
							<label for="orang">Banyaknya Orang</label>
							<input type="text" name="orang" value="<?php echo $this->input->post('orang'); ?>" readonly>
						</div>
						<div class='simple'>
							<label for="waktu">Tanggal Penjemputan</label>
							<input type="text" name="waktu" value="<?php echo $this->input->post('waktu'); ?>" readonly>
						</div>
						<div class='simple'>
							<label for="jam">Jam Penjemputan</label>
							<input type="text" name="jam" value="<?php echo $this->input->post('jam'); ?>" readonly>
						</div>
						<div class='simple'>
							<?php if($this->input->post('orang') > 1): ?>
							<label for="biaya">Biaya per orang</label>
							<?php else: ?>
							<label for="biaya">Biaya</label>
							<?php endif; ?>
							<input type="text" name="biaya" value="<?php echo $biaya ?>">
						</div>
						
						<?php if($this->input->post('orang') == 1): ?>
							<?php if($this->session->userdata('email')): ?>
						<div class='simple' style='border-top:1px dashed #999;padding-top:10px'>
							<label for="diri">Pakai Data Diri?</label>
							<input type="checkbox" id='diri' name="diri" onchange='oncekuser()'>
						</div>
							<?php endif; ?>
						<div class='simple'>
							<label for="penumpang">Nama Penumpang</label>
							<input type="text" id='penumpang' name="penumpang" value="">
						</div>
						<div class='simple'>
							<label for="emailp">Email</label>
							<input type="text" id='emailp' name="emailp" value="">
						</div>
						<div class='simple'>
							<label for="alamat">Alamat Tujuan</label>
							<input type="text" id='alamat' name="alamat" value="" class='required'>
						</div>
						<div class='simple'>
							<label for="telpon">No. Telpon/HP</label>
							<input type="text" id='telpon' name="telpon" value="" class='required number'>
						</div>
						<div class='simple'>
							<label for="catatan">Catatan</label>
							<textarea id='catatan' name="catatan"></textarea>
						</div>
						<?php else: ?>
						<div id="tabs" style='width:750px'> 
					    <ul style='width:750px'>
					    	<?php for($i = 1; $i <= $orang; $i++): ?>
					      <li style='padding:0 10px'><a href="#tab-<?php echo $i ?>">Orang ke-<?php echo $i ?></a></li>
					      <?php endfor; ?>
					    </ul>
					    <?php for($i = 1; $i <= $orang; $i++): ?> 
					    <div id="tab-<?php echo $i ?>">
					    	<?php if($i == 1): ?>
				    			<?php if($this->session->userdata('email')): ?>
								<p class='tab'>
									<label for="diri">Pakai Data Diri?</label>
									<input type="checkbox" id='diriall' name="diriall" onchange='oncekuserall()'>
								</p>
									<?php endif; ?>
								<?php endif; ?>
								<p class='tab'>
									<label for="penumpang">Nama Penumpang</label>
									<input type="text" id='penumpang<?php echo $i ?>' name="penumpang<?php echo $i ?>" value="" class='required'>
								</p>
								<?php if($i == 1): ?>
								<p class='tab'>
									<label for="emailp">Email</label>
									<input type="text" id='emailp<?php echo $i ?>' name="emailp<?php echo $i ?>" value="" class='required'>
								</p>
								<?php endif; ?>
								<p class='tab'>
									<label for="alamat">Alamat</label>
									<input type="text" id='alamat<?php echo $i ?>' name="alamat<?php echo $i ?>" value="" class='required'>
								</p>
								<p class='tab'>
									<label for="telpon">No. Telpon/HP</label>
									<input type="text" id='telpon<?php echo $i ?>' name="telpon<?php echo $i ?>" value="" class='required number'>
								</p>
								<p class='tab'>
									<label for="catatan">Catatan</label>
									<textarea id='catatan<?php echo $i ?>' name="catatan<?php echo $i ?>"></textarea>
								</p>
					    </div><!--#tab-<?php echo $i ?>-->
					    <?php endfor; ?>
				    </div> <!--#tabs-->
				    <?php endif; ?>
						<div class='simple'>
							<label for="submit">&nbsp;</label>
							<input type="submit" name="submit" value="Kirim">
						</div>
						<script type="text/javascript" charset="utf-8">
							function oncekuser() {
								if(document.getElementById('diri').checked == true) {
									<?php foreach($user as $row): ?>
									$('#penumpang').val('<?php echo $row->nama ?>').attr({readonly:'true'});
									$('#emailp').val('<?php echo $row->email ?>').attr({readonly:'true'});
									$('#telpon').val('<?php echo $row->telpon ?>');
									$('#alamat').val('<?php echo $row->alamat ?>');
									<?php endforeach; ?>
								} else {
									$('#penumpang').val('').removeAttr('readonly');
									$('#emailp').val('').removeAttr('readonly');
									$('#telpon').val('');
									$('#alamat').val('');
								}
							}
							function oncekuserall() {
								if(document.getElementById('diriall').checked == true) {
									<?php foreach($user as $row): ?>
									$('#penumpang1').val('<?php echo $row->nama ?>').attr({readonly:'true'});
									$('#emailp1').val('<?php echo $row->email ?>').attr({readonly:'true'});
									$('#telpon1').val('<?php echo $row->telpon ?>');
									$('#alamat1').val('<?php echo $row->alamat ?>');
									<?php endforeach; ?>
								} else {
									$('#penumpang1').val('').removeAttr('readonly');
									$('#emailp1').val('').removeAttr('readonly');
									<?php for($i = 1; $i < 8; $i++): ?>
									$('#penumpang<?php echo $i ?>').val('').removeAttr('readonly');
									$('#emailp<?php echo $i ?>').val('').removeAttr('readonly');
									<?php endfor; ?>
									$('#telpon1').val('');
									$('#alamat1').val('');
								}
							}
						</script>
					</fieldset>
				</form>
			</div>
		</div><!--#middle-->
		
	</div><!--#content-->

<?php echo $this->load->view('include/footer'); ?>