<?php echo $this->load->view('include/header'); ?>

	<?php echo $this->load->view('include/menu'); ?>
	
		<div id="middleantar">
			<div id="antar">
				<form id='formpenukaran' action="<?php echo base_url() ?>money/insert" method="post">
					
					<fieldset>
						<legend>Detail Pemesan</legend>
						<div class='simple'>
							<label for="nama">Nama </label>
							<input type='text' value="<?php echo $pemesan ?>" readonly name="pemesan">
						</div>
						<div class='simple'>
							<label for="alamat">Alamat</label>
							<input type='text' name="alamat" value="<?php echo $alamat ?>" readonly>
						</div>
						<div class='simple'>
							<label for="telp">No Telepon</label>
							<input type='text' name="telp" value="<?php echo $telp ?>" readonly>
						</div>
						<div class='simple'>
							<label for="telp">Jumlah Penukaran</label>
							<input type='text' name="jml" value="<?php echo $jml ?>" readonly>
						</div>
							<div class='simple'>
							<label for="emailp">Jenis Penukaran</label>
							<input type='text' name="jenis" value="<?php echo $jenis ?>" readonly>
						</div>
						<div class='simple'>
							<label for="cabang">Cabang Pemesan</label>
						<select id='kota' name="kota" class='required'>
								<option value="" selected></option>
								<?php foreach($kota as $kt): ?>
								<option value="<?php echo $kt->nama ?>"><?php echo $kt->nama ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</fieldset>
					<fieldset>
						<legend>Jenis Mata Uang</legend>
						<?php if($jml == 1): ?>
						<div class='simple'>
							<label for="penumpang">Mata Uang</label>
							<select id='matauang' name="matauang" class='required'>
								
								<?php foreach($jual as $mt): ?>
								<option value="<?php echo $mt->id_kurs ?>"><?php echo $mt->mata_uang ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					
						<div class='simple'>
							<label for="alamat">Jumlah Tukar</label>
							<input type='text' name="jumlah">
						</div>
						
						<?php else: ?>
						<div id="tabs" style='width:750px'> 
					    <ul style='width:750px'>
					    	<?php for($i = 1; $i <= $jml; $i++): ?>
					      <li style='padding:0 10px'><a href="#tab-<?php echo $i ?>">Mata Uang ke-<?php echo $i ?></a></li>
					      <?php endfor; ?>
					    </ul>
					    <?php for($i = 1; $i <= $jml; $i++): ?> 
					    <div id="tab-<?php echo $i ?>">
					    	
								<p class='tab'>
								<label for="penumpang">Mata Uang</label>
							<select id="matauang<?php echo $i ?>" name="matauang<?php echo $i ?>" class='required'>
								
								<?php foreach($jual as $mt): ?>
								<option value="<?php echo $mt->id_kurs ?>"><?php echo $mt->mata_uang ?></option>
								<?php endforeach; ?>
							</select>
								</p>
								
								<p class='tab'>
									<label for="jumlah">Jumlah Tukar</label>
									<input type='text' name="jumlah<?php echo $i ?>" id="jumlah<?php echo $i ?>">
								</p>
								
					    </div><!--#tab-<?php echo $i ?>-->
					    <?php endfor; ?>
				    </div> <!--#tabs-->
				    <?php endif; ?>
						<div class='simple'>
							<label for="submit">&nbsp;</label>
							<input type="submit" name="submit" value="Order">
						</div>
					</fieldset>
				
					</form>
					</div>
					
</div><!--#middle-->
		
	</div><!--#content-->

<?php echo $this->load->view('include/footer'); ?>