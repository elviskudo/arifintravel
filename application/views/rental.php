<?php echo $this->load->view('include/header'); ?>

<script type="text/javascript">
	function popUp(mypage,w,h,scroll){
		LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
		TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
		settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+'';
		var myw = window.open(mypage,"myw",settings);
	}
</script>
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
			<h2 align="center">TOUR &amp; TRAVEL , RENT CAR  BANDARA JUANDA </h2>
			<h2 align="center">INTERNASIONAL SURABAYA&nbsp; </h2>
			<h2 align="center">PHONE: 031-8688533 / 08113539472  / 081553600005</h2>
			<hr />
			</div>
			<div> 
<form id='rental' action="<?php echo base_url() ?>rental/persewaan" method="post" accept-charset="utf-8">

<table cellpadding="2" cellspacing="2" align="center">		    	
<a href="http://arifintravel.com/PETUNJUK.txt" target="_blank"><div style="color: #b45f06;">Klik Disini, Baca Petunjuk Pengisian, Agar Tidak Terjadi ERROR Invoice!</div></a>
<br><p>
						<tr>
							<td>
							<label for="nama">ID member </label></td>
							<td width="20" align="center">:</td> 
							<td>
							<input type='text' name="id_member"> 
			<?php echo "<a href=\"#\" onClick=\"popUp('".base_url()."popup/member/tambah',500,450,'yes');\">
			<img src=\"".base_url()."images/insert.gif\" border=\"0\" id=\"cx_find\" alt=\"add\" style=\"cursor:pointer;cursor:hand;\">
			 TAMBAH DATA BARU</a>"; ?>

                        <?php echo "<a href=\"#\" onClick=\"popUp('".base_url()."popup/member',500,450,'yes');\">
			<img src=\"".base_url()."images/ew_find.gif\" border=\"0\" id=\"cx_find\" alt=\"Find\" style=\"cursor:pointer;cursor:hand;\">
			 CARI DATA LAMA</a>"; ?>
						
							</td>
						</tr>
						<tr>
							<td>
							<label for="nama">Nama </label></td>
							<td width="20" align="center">:</td> 
							<td>
							<input type='text' name="nama">
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
							<td><label for="alamat">No. Identitas</label></td>
							<td align="center">:</td>
							<td> 
							<input type='text' name="no_id">
							</td>
						</tr>
						<tr>
							<td><label for="telp">No Telepon</label></td>
							<td align="center">: </td>
							<td><input type='text' name="telp"></td>
						</tr>
						<tr>
							<td><label for="telp">Tujuan</label></td>
							<td align="center">: </td>
							<td><input type='text' name="tujuan"></td>
						</tr>
						<tr>
						<td></td><td></td>
						<td align="left">
<br>
						<input type="submit" value="Order">
						</td>
						</tr>
					
</table>
</form>
		    </div> 
<br>
			<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
<center><h3>Syarat dan Ketentuan Rental Mobil.</h3></center>
<p>Berikut ini adalah Syarat dan ketentuan dalam  menggunakan jasa penyewaan mobil di PT.Arifin Sidayu<br />
<br>
    <strong><b><h4>Syarat Umum Untuk penduduk di luar kota Surabaya/WNA (warga negara asing) :</h4></b></strong></p>
	<br />
	<table cellpadding="1" cellspacing="1" width="525" align="center">
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Fotocopi KTP / Pasport Asli</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">SIM ( surat ijin  mengemmudi)&nbsp; Driving License</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Pembayaran pemakaian di  bayar di muka</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Deposit utk rent car tanpa  Driver IDR 1.000.000,- / USD 100,-</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">NO Telp Rumah sesuai  alamat di&nbsp; KTP / no telp Perusahaan&nbsp; di mana dia&nbsp;  bekerja ( aktif )&nbsp;-</td>
		</tr>

	</table>

<br />

<strong><b>
<h4>Syarat Perusahaan : </h4>
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

    <strong><b><h4>Syarat Rental Mobil dgn Supir :</h4></b></strong></p>
	<br />
	<table cellpadding="1" cellspacing="1" width="525" align="center">
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Bensin dan ban bocor adalah sepenuhnya tanggung jawab dari  Penyewa terkecuali  Calter ( bbm dll akan di tanggung ) </td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Tanggungan Supir seperti makan siang, makan malam dan tempat istirahat adalah tanggung jawab  Penyewa. </td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Waktu sewa dihitung semenjak kendaraaan di berangkatkan dari Bandara Juanda  dan kembali ke Bandara Juanda  (sampai serah terima)</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Toleransi keterlambatan adalah 4 jam. Selanjutnya dihitung sebagai penambahan selama satu hari penuh.</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">NO Keterlambatan 1 sampai 4 jam di kenakan biaya 10 % / jam </td>
		</tr>

	</table>

<br />

<strong><b><h4>Syarat Rental Mobil tanpa Supir (Self Driver) :</h4></b></strong></p>
	<br />
	<table cellpadding="1" cellspacing="1" width="525" align="center">
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Penyewa harus memiliki Surat Izin Mengemudi, Dalam hal ini adalah SIM A yang masih aktif dan berlaku di Negara Republik Indonesia.</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Harga Sewa mobil dihitung 24 Jam. Tergantung kepada Jenis mobil.</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Toleransi keterlambatan adalah 4 jam. Selanjutnya dihitung sebagai penambahan selama satu hari penuh.</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Tidak diizinkan membawa mobil ke luar Jawa Timur Tanpa Izin dari Sewa Mobil PT.ARIFIN SIDAYU</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Ban bocor dan atau BBM adalah tanggung jawab dari si Penyewa.</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Waktu sewa dihitung semenjak kendaraan diberangkatkan dari Bandara juanda  dan kembali ke bandara Juanda  tanpa ada kerusakan.</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">
Kerusakan kendaraan yang terjadi karena kelalaian penyewa, sepenuhnya menjadi tanggung jawab penyewa.</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Kerusakan pada mobil yang di sewa (Lecet atau penyok) hanya di kenakan biaya klaim asuransi minor & Administrasi sebesar Rp. 350.000,-</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Untuk kerusakan besar yang membuat mobil tidak dapat beroperasi seperti kaca pecah, dan lain lain, akan di kenakan klaim asuransi major sebesar harga sewa mobil sebulan atau selama mobil tidak dapat beroperasi. Kecuali terjadi force majuer.</td>
		</tr>
<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Apabila STNK hilang, biaya penggantiannya adalah Rp. 750.000,-</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Apabila Kunci mobil hilang, Biaya penggantiannya adalah Rp. 250.000,-</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Akan dikenakan biaya Rp. 200.000 apabila tools yang kami sediakan di dalam mobil hilang, Seperti Dongkrak, kunci, dll</td>
		</tr>
	</table>

<br />

<strong><b>
<h4>Untuk sewa bulanan :</h4>
</b></strong></p>
	<br />
	<table cellpadding="1" cellspacing="1" width="525" align="center">
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Perawatan mobil menjadi tanggung jawab penyewa.</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Bila ada kecelakaan yang mengakibatkan mobil tidak dapat beroprasi, kami akan mengganti mobil tersebut dengan mobil lain sesuai ketentuan yang berlaku.</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Untuk kerusakan besar yang membuat mobil tidak dapat beroperasi seperti kaca pecah, dan lain lain, akan di kenakan klaim asuransi major sebesar harga sewa mobil sebulan atau selama mobil tidak dapat beroperasi.</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Apabila STNK hilang, biaya penggantiannya adalah Rp. 750.000,-</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Apabila Kunci mobil hilang, Biaya penggantiannya adalah Rp. 250.000,-</td>
		</tr>
		<tr>
			<td width="25" style="padding-left:15px;"><img src="<?php echo base_url(); ?>images/check.gif" /></td><td style="padding-bottom:2px;">Akan dikenakan biaya Rp. 200.000 apabila tools yang kami sediakan di dalam mobil hilang, Seperti Dongkrak, kunci, dll. </td>
		</tr>
	
	</table>
<br />
</div>

        </div><!--#middle-->
		
		<div id="right">
			<?php echo $this->load->view('include/mobil'); ?>
			
			
		</div><!--#right-->
		
	</div><!--#content-->

<?php echo $this->load->view('include/footer'); ?>
