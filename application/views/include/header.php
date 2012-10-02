<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Selamat Datang di Arifin Travel</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/reset.css" media="screen">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/default.css" media="screen">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/datePicker.css" media="screen">
	<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-1.6.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.cycle.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.jcarousel.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.pack.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.maskedinput-1.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>js/date.js"></script>
	<!--[if lt IE 7]><script type="text/javascript" src="<?php echo base_url() ?>js/jquery.bgiframe.min.js"></script><![endif]-->
	<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.datePicker.js"></script>
	<script type="text/javascript">
		/* validate */
		$(document).ready(function() {
			//$("#tanggal_antar").mask("9999-99-99");
			$(".jam").mask("99:99");
			$('#formAntar').validate();
			$('#antar').validate();
			$('#jemput').validate();
		});
		/* date */
		$(document).ready(function() {
			$('.date-pick').datePicker();
		});
		/* slideshow */
		$(document).ready(function() {
			$('#slideshow').cycle({
				fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
			});
		});
		/* carousel */
		function mycarousel_initCallback(carousel) {
			// Disable autoscrolling if the user clicks the prev or next button.
			carousel.buttonNext.bind('click', function() {
			  carousel.startAuto(0);
			});
			carousel.buttonPrev.bind('click', function() {
			  carousel.startAuto(0);
			});
			// Pause autoscrolling if the user moves with the cursor over the clip.
			carousel.clip.hover(function() {
			  carousel.stopAuto();
			}, function() {
			  carousel.startAuto();
			});
		};
		jQuery(document).ready(function() {
			jQuery('#mycarousel').jcarousel({
			  auto: 2,
			  wrap: 'last',
			  initCallback: mycarousel_initCallback
			});
		});		
		/* tab */
		$(document).ready(function(){
			$('#tabs div').hide();
			$('#tabs div:first').show();
			$('#tabs ul li:first').addClass('active');
			$('#tabs ul li a').click(function() {
				$('#tabs ul li').removeClass('active');
				$(this).parent().addClass('active'); 
				var currentTab = $(this).attr('href'); 
				$('#tabs div').hide();
				$(currentTab).show();
				return false;
			});
		});
		/* rubah jam */
		$(document).ready(function() {
			$('#kota :first').attr('selected','selected');
		});
		$("#loading").ajaxStart(function() {
			$(this).show();
		});
		$("#loading").ajaxStop(function() {
			$(this).hide();
		});
		function getJam(id) {
			$.ajax({
				url				: '<?php echo base_url() ?>main/jam/'+id,
				type			: 'POST',
				dataType	: 'html',
				success		: function(data) {
					$('#jam').html(data);
				}
			});
		}
	</script>
</head>
<body>
	<div class='header'>
		<div id="header">
			<div id="logo">
				<img src="<?php echo base_url() ?>images/logo.gif" alt="">
			</div>
			<div id='menu'>
				<ul>
					<li>
						<input id='home' type="button" name="home" value="HOME" onclick="location.href='<?php echo base_url() ?>'">
					</li>
					<li>
						<?php if($this->session->userdata('email')): ?>
						<p style='float:right;margin-top:7px;'>
							Selamat Datang <b style='font-weight:bold'><?php echo $this->session->userdata('nama'); ?></b> | <a href="<?php echo base_url() ?>daftar/profil">lihat profil</a> | <a href="<?php echo base_url() ?>daftar/histori">histori perjalanan</a> | <a href="<?php echo base_url() ?>logout">logout</a>
						</p>
						<?php else: ?>
						<form action="<?php echo base_url() ?>login/process" method="post" accept-charset="utf-8">
							member login
							<input type="text" name="email" value="email" onblur='if(this.value=="")this.value="email"' onfocus="if(this.value=='email')this.value=''">
							<input type="password" name="password" value="">
							<input type="submit" value="Login">
                                                        
						</form>
						<?php endif; ?>	
					</li>
				</ul>
				<div class='clear'></div>
			</div>
		</div><!--#header-->
	</div>
	<div class='clear'></div>
	
