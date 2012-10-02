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
			<h2 align="center">PT . ARIFIN SIDAYU</h2>
			<h2 align="center">FORM PEMESANAN TIKET </h2>
			<h2 align="center">PHONE: 031-8688533 / 08113539472  / 081553600005</h2>
			<hr />
			</div>
			

<form id='tiket' action="<?php echo base_url() ?>tiket/pemesanan" method="post" accept-charset="utf-8">
<table cellpadding="2" cellspacing="2" align="center">
						<tr>
							<td>
							<label for="kota">Berangkat Dari </label></td>
							<td width="20" align="center">:</td> 
							<td>
							<input type="text" id='dari' name="dari" />
							
							</td>
						</tr>
						<tr>
							<td><label for="tujuan">Tujuan</label></td>
							<td align="center">:</td>
							<td><input type="text" id='tujuan' name="tujuan" value=""></td>
						</tr>
						<tr>
							<td><label for="tanggal">Tanggal Berangkat</label></td>
							<td align="center">:</td>
							<td><input type="text" id='tgl_berangkat' class='date-pick' name="tgl_berangkat" value=""></td>
						</tr>
						
						<tr>
							<td><label for="orang">Orang</label></td>
							<td align="center">:</td>
							<td> 
							<select name="orang">
								<?php for($i = 1; $i <= 8; $i++): ?>
								<option value='<?php echo $i ?>'><?php echo $i ?></option>
								<?php endfor; ?>
							</select>
							</td>
						</tr>
						<tr>
							<td><label for="tujuan">Maskapai</label></td>
							<td align="center">:</td>
							<td><input type="text" id='maskapai' name="maskapai" value=""></td>
						</tr>
						<tr>
							<td><label for="jam">Jam Berangkat</label></td>
							<td align="center">: </td>
							<td><input type='text' id='jam' name="jam" value='' class='required jam'></td>
						</tr>
						
						<tr>
						<td colspan="3" align="center">
						<input type="submit" value="Order">
						</td>
						</tr>
					
</table>
</form>
		    </div> 

<div id="right">
			<?php echo $this->load->view('include/maskapai'); ?>
			
			
		</div><!--#right-->

		
	</div><!--#content-->
		
<?php echo $this->load->view('include/footer'); ?>