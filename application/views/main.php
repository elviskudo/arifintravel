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
			<div id="pagination">
				<div id="slideshow">
					<img src="<?php echo base_url() ?>images/banner-tiket.jpg" alt='' />
					<a href="<?php echo base_url() ?>rental"><img src="<?php echo base_url() ?>images/banner-sewa-mobil.jpg" alt='' border="0" /></a>
					<a href="<?php echo base_url() ?>money"><img src="<?php echo base_url() ?>images/banner-changer.jpg" alt='' /></a>
					<img src="<?php echo base_url() ?>images/banner-jemput.jpg" alt='' />
				</div>
			</div>
			<div id="latest">
				<h3>Kabar Terbaru dari Arifin Travel</h3>
				<ul id="mycarousel" class="jcarousel-skin-tango">
			    <li>
			    	<a href='http://www.airasia.com' target='_blank'>
			    		<img src="<?php echo base_url() ?>images/airasia.jpg" width="48" height="48" alt="" />
			    	</a>
		    	</li>
			    <li>
			    	<a href='http://www.mandalaair.com/' target='_blank'>
				    	<img src="<?php echo base_url() ?>images/mandala.jpg" width="48" height="48" alt="" />
			    	</a>
		    	</li>
			    <li>
			    	<a href='http://www.bruneiair.com' target='_blank'>
				    	<img src="<?php echo base_url() ?>images/rba.jpg" width="48" height="48" alt="" />
				    </a>
				  </li>
			    <li>
			    	<a href='http://www.batavia-air.com' target='_blank'>
				    	<img src="<?php echo base_url() ?>images/batavia.jpg" width="48" height="48" alt="" />
				    </a>
				  </li>
			    <li>
			    	<a href='http://www.china-airlines.com/en/index.htm' target='_blank'>
				    	<img src="<?php echo base_url() ?>images/china.jpg" width="48" height="48" alt="" />
				    </a>
				  </li>
			    <li>
			    	<a href='http://www.citilink.co.id' target='_blank'>
				    	<img src="<?php echo base_url() ?>images/citilink.jpg" width="48" height="48" alt="" />
				    </a>
				  </li>
			    <li>
			    	<a href='http://www.garuda-indonesia.com' target='_blank'>
				    	<img src="<?php echo base_url() ?>images/garuda.jpg" width="48" height="48" alt="" />
				    </a>
				  </li>
			    <li>
			    	<a href='http://www2.lionair.co.id' target='_blank'>
				    	<img src="<?php echo base_url() ?>images/lionair.jpg" width="48" height="48" alt="" />
				    </a>
				  </li>
			    <li>
			    	<a href='http://www.merpati.co.id' target='_blank'>
				    	<img src="<?php echo base_url() ?>images/merpati.jpg" width="48" height="48" alt="" />
				    </a>
				  </li>
			  </ul>
			</div>
		</div><!--#middle-->
		
		<div id="right">
			<div id="tabs"> 
		    <ul> 
		      <li><a href="#tab-1">Pengantaran</a></li>
		      <li><a href="#tab-2">Penjemputan</a></li>
		    </ul> 
		    <div id="tab-1"> 
		    	<form id='antar' action="<?php echo base_url() ?>pesawat" method="post" accept-charset="utf-8">
						<p>
							<label for="kota">Kota</label>
							: <select id='kota' name="kota" class='required'>
								<option value="" selected></option>
								<?php foreach($kota as $kt): ?>
								<option value="<?php echo $kt->id_kota ?>"><?php echo $kt->nama ?></option>
								<?php endforeach; ?>
							</select>
						</p>
						<p>
							<label for="tanggal_antar">Tanggal</label>
							: <input type="text" id='tanggal_antar' class='date-pick' name="tanggal_antar" value="" class='required'>
						</p>
						<p>
							<label for="tujuan">Tujuan</label>
							: <input type='text' readonly value='Juanda Surabaya'>
							</select>
						</p>
						<p>
							<label for="orang">Orang</label>
							: <select name="orang">
								<?php for($i = 1; $i <= 8; $i++): ?>
								<option value='<?php echo $i ?>'><?php echo $i ?></option>
								<?php endfor; ?>
							</select>
						</p>
						<input type="submit" value="Search">
						<div id="loading" display:'block'>loading...</div>
					</form>
		    </div> 
		    <div id="tab-2"> 
		      <form id='jemput' action="<?php echo base_url() ?>jemput" method="post" accept-charset="utf-8">
		      	<input type="hidden" name="login_type" value="jemput">
						<p>
							<label for="asal">Dari</label>
							: <input type='text' name='asal' value='Juanda Surabaya' readonly>
							</select>
						</p>
						<p>
							<label for="kota">Ke Kota</label>
							: <select id='kota' name="kota" class='required'>
								<option value="" selected></option>
								<?php foreach($kota as $kt): ?>
								<option value="<?php echo $kt->id_kota ?>"><?php echo $kt->nama ?></option>
								<?php endforeach; ?>
							</select>
						</p>
						<p>
							<label for="waktu">Tanggal</label>
							: <input type="text" id='waktu' name="waktu" value="" class='required date-pick'>
						</p>
						<p>
							<label for="jam">Jam</label>
							: <input type='text' id='jam' name="jam" value='' class='required jam'>
						</p>
						<p>
							<label for="orang">Orang</label>
							: <select name="orang">
								<?php for($i = 1; $i <= 7; $i++): ?>
								<option value='<?php echo $i ?>'><?php echo $i ?></option>
								<?php endfor; ?>
							</select>
						</p>
						<input type="submit" value="Search">
						<div id="loading" display:'block'>loading...</div>
					</form>
		    </div> 
		  </div> <!--#tabs-->
			
			<?php echo $this->load->view('include/guide'); ?>
		</div><!--#right-->
		
	</div><!--#content-->

<?php echo $this->load->view('include/footer'); ?>