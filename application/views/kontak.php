<?php echo $this->load->view('include/header'); ?>


<div id="content">
		<div id="left">
		<ul>		
<li><a href="#">profil</a></li>
				<li><a href="<?php echo base_url() ?>rental">info Rental Mobil</a></li>
				<li><a href="<?php echo base_url() ?>tiket">info tiket pesawat</a></li>
				<li><a href="<?php echo base_url() ?>money">info money changer</a></li>
				<li><a href="#">kontak kami</a></li>
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
		
	
	<form name="freecontactform" method="post" action="freecontactformprocess.php" onsubmit="return validate.check(this)">
	<table width="400px" class="freecontactform">
	<tr>
	 <td colspan="2">
	  
	 <div class="freecontactformheader">Kontak Kami</div>
	  
	 <div class="freecontactformmessage">Kotak form dengan tanda <span class="required_star"> * </span> berarti HARUS di isi.</div>
	  <br>
	 </td>
	</tr>

	<tr>
	 <td valign="top">
	  <label for="Full_Name" class="required">Nama Lengkap<span class="required_star"> * </span></label>
	 </td>
	 <td valign="top">
	  <input type="text" name="Full_Name" id="Full_Name" maxlength="80" style="width:230px">
	 </td>
	</tr>
	<tr>
	 <td valign="top">
	  <label for="Email_Address" class="required">Alamat Email<span class="required_star"> * </span></label>
	 </td>
	 <td valign="top">
	  <input type="text" name="Email_Address" id="Email_Address" maxlength="400" style="width:230px">
	 </td>
	</tr>
	<tr>
	 <td valign="top">
	  <label for="Telephone_Number" class="not-required">Nomor Telepon</label>
	 </td>
	 <td valign="top">
	  <input type="text" name="Telephone_Number" id="Telephone_Number" maxlength="100" style="width:230px">
	 </td>
	</tr>
	<tr>
	 <td valign="top">
	  <label for="Your_Message" class="required">Pesan Anda<span class="required_star"> * </span></label>
	 </td>
	 <td valign="top">
	  <textarea style="width:230px;height:160px" name="Your_Message" id="Your_Message" maxlength="2000"></textarea>
	 </td>
	</tr>
	<tr>
	 <td colspan="2" style="text-align:center" >
<br>
	  <div class="antispammessage">
	  Untuk menjaga dari kemungkinan spam, tolong jawab pertanyaan sederhana berikut:
	  <br /><br />
		  <div class="antispamquestion">
		   <span class="required_star"> * </span>
		   Isi hanya dengan nomor, berapa hasil dari 10+15? &nbsp; 
		   <input type="text" name="AntiSpam" id="AntiSpam" maxlength="300" style="width:30px">
		  </div>
	  </div>
	 </td>
	</tr>
	<tr>
	 <td colspan="2" style="text-align:center" >
	 <br /><br />
	  <input type="submit" value=" Submit Form ">
	  <br /><br />
	  <div style="font-size:0.9em"> <a href="http://www.arifintravel.com" target="_blank">Arifin Travel</a></div>
	  <br /><br />
	 </td>
	</tr>
	</table>
	</form>
		    </div> 

<div id="right">
			
			
			
		</div><!--#right-->

		
	</div><!--#content-->
		
<?php echo $this->load->view('include/footer'); ?>