<?php echo $this->load->view('include/header'); ?>


<div id="content">
		<div id="left">
		<ul>
				
				<li><a href="blog/tentang-kami">profil</a></li>
				<li><a href="<?php echo base_url() ?>rental">info Rental Mobil</a></li>
				<li><a href="<?php echo base_url() ?>tiket">info tiket pesawat</a></li>
				<li><a href="<?php echo base_url() ?>money">info money changer</a></li>
				<li><a href="blog/kontak-kami">kontak kami</a></li>
			</ul>
			<div class="box">
				<h3>how do i?</h3>
				<ul>
					<li><a href="#"><img src="<?php echo base_url() ?>images/help.gif" alt="">ask arifin travel</a></li>
					<li><a href="#"><img src="<?php echo base_url() ?>images/contact.gif" alt="">contact us</a></li>
					<li><a href="#"><img src="<?php echo base_url() ?>images/seat.gif" alt="">pick a seat</a></li>
					<li><a href="#"><img src="<?php echo base_url() ?>images/bag.gif" alt="">pick up my baggage</a></li>
					<li><a href="#"><img src="<?php echo base_url() ?>images/meals.gif" alt="">pre-book</a></li>
					<li><a href="#"><img src="<?php echo base_url() ?>images/clock.gif" alt="">self check-in</a></li>
				</ul>
			</div>
		</div><!--#left-->
		
		<div id="middle">
			<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px" >
			<h2 align="center">PT. ARIFINDO</h2>
			<h2 align="center">arifintravel.com | MONEY CHANGER</h2>
			<h2 align="center">PHONE: 031-3940728 / 08113539472  / 081553600005</h2>
			<hr />
			</div>
			
			<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">

<p>Selain menyediakan Tiket Pesawat, Jasa Pengantaran dan Penjemputan, kami juga lengkapi dengan menyediakan Alat Tukar (Money Changer) berupa Mata Uang Asing (Dollar Amerika ; Euro ; Dollar Singapura ; Yen Jepang dan Rial UEA) untuk Akomodasi Perjalanan maupun untuk Investasi.<br />
    <strong><b><h4>Silahkan cek konversi mata uang yang anda inginkan, Konversi mata uang kami selalu up to date.</h4></b></strong></p>
	<br />
	<table cellpadding="1" cellspacing="1" width="525" align="center">
		<tr>
			<td style="padding-bottom:2px;" align="center"><img src="<?php echo base_url() ?>images/kurs.jpg" alt=""></td>
		</tr>
		
	</table>

<br />

<div> 
<form id='antar' action="<?php echo base_url() ?>money/penukaran" method="post" accept-charset="utf-8">

<table cellpadding="2" cellspacing="2" align="center">
		    	
						<tr>
							<td>
							<label for="nama">Nama </label></td>
							<td width="20" align="center">:</td> 
							<td>
							<input type='text' name="pemesan">
							</td>
						</tr>
						<tr>
							<td><label for="alamat">Alamat</label></td>
							<td align="center">:</td>
							<td> 
							<input type='text' name="alamat">
							</td>
						</tr>
						<tr>
							<td><label for="telp">No Telepon</label></td>
							<td align="center">: </td>
							<td><input type='text' name="telp"></td>
						</tr>
						<tr>
							<td><label for="telp">Jumlah Penukaran</label></td>
							<td align="center">: </td>
							<td><input type='text' name="jml"></td>
						</tr>
						<tr>
							<td><label for="telp">jenis</label></td>
							<td align="center">: </td>
							<td><select id='matauang' name="jenis" class="required">
							<option value="JUAL">JUAL</option>
							<option value="BELI">BELI</option>	
							</select></td>
						</tr>
						
						<tr>
						<td colspan="3" align="right">
						<input type="submit" value="Order">
						</td>
						</tr>
					
</table>
</form>
		    </div> 

<strong><b>
<h4>Ketentuan Order Sebagai Berikut : </h4>
</b></strong></p>
	<br />
	<table cellpadding="1" cellspacing="1" width="525" align="center">
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Fotokopi SIUP dan NPWP</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Fotokopi akte pendirian perusahaan</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Surat keterangan domisili perusahaan</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Surat pemesanan kendaraan</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Fotokopi pemohon</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Fotokopi Tanda Daftar perusahaan</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Fotokopi KTP direksi, atau pejabat yang bertanggung jawab</td>
		</tr>
<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Surat kuasa bila bukan direktur perusahaan yang bertanggung jawab</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Fotokopi SIM pengemudi</td>
		</tr>
	</table>
<br />

<br />
</div>

        </div><!--#middle-->
		
		<div id="right">
		<h3 align="center">INFO KURS MATA UANG <br />Hari ini : <?php echo date("d-m-Y"); ?></h3>
			<div id="tabs"> 
		    <ul> 
		      <li><a href="#tab-1">Harga Jual</a></li>
		      <li><a href="#tab-2">Harga Beli</a></li>
		    </ul> 
		    <div id="tab-1"> 
				<br />
		    	<table cellpadding="1" cellspacing="1" width="200" border="1">
				<?php foreach($jual as $jl): ?>
				<tr valign="middle">
				<td valign="middle"><img width="40" height="25" src="<?php echo base_url(); ?>images/<?php echo $jl->bendera;?>" alt="<?php echo $jl->bendera;?>"/></td>
				<td width="100" valign="top" style="padding-left:1px"><?php echo $jl->mata_uang;?></td>
				<td width="10">:</td>
				<td width="40" valign="middle" align="right" style="font-weight:bolder;"><strong><?php echo $jl->jual;?></strong></td>
				</tr>
								
				<?php endforeach; ?>
				</table>
				
		    </div> 
		    <div id="tab-2"> 
		     <br />
		    	<table cellpadding="1" cellspacing="1" width="200" border="1">
				<?php foreach($jual as $jl): ?>
				<tr valign="middle">
				<td valign="middle"><img width="40" height="25" src="<?php echo base_url(); ?>images/<?php echo $jl->bendera;?>" alt="<?php echo $jl->bendera;?>"/></td>
				<td width="100" valign="top" style="padding-left:1px"><?php echo $jl->mata_uang;?></td>
				<td width="10">:</td>
				<td width="40" valign="middle" align="right" style="font-weight:bolder;"><strong><?php echo $jl->beli;?></strong></td>
				</tr>
								
				<?php endforeach; ?>
				</table>
		    </div> 
		  </div> <!--#tabs-->
			<img width="240" height="150" src="<?php echo base_url(); ?>images/banner-changer.jpg" alt="banner-changer.jpg"/>
			
		</div><!--#right-->
		
	</div><!--#content-->

<?php echo $this->load->view('include/footer'); ?>
