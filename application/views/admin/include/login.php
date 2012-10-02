<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Arifin Travel - Login Page</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/reset.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/default.css">
		<style type='text/css' media='screen'>
			html, body { background:#2d2d2d; }
			#login {
				background:#fff;
				border:1px solid #ccc;
				margin:200px auto;
				padding:20px;
				width:480px;
				-moz-border-radius:10px;
				-webkit-border-radius:10px;
				border-radius:10px;
			}
			#login_form { text-align:left; }
			.simple { margin:20px 0; }
			.simple label { float:left; width:80px; }
		</style>
	</head>
	</body>
		<div id='login' style='display:block'>
			<img src='<?php echo base_url() ?>images/logo-invoice.png' style='height:58px;width:400px'>
			<form id='login_form' method='post' action='<?php echo base_url() ?>admin/login/force/'>
			<?php if($this->session->userdata('error')): ?>
				<p style='background:#ff0;border:1px solid #f00;color:#f00;padding:5px;'><?php echo $this->session->userdata('error') ?></p>
			<?php $this->session->unset_userdata('error'); endif; ?>
				<div class='simple'>
					<label for='email'>Login: </label>
					<input type='text' id='email' name='email' size='30' />
				</div>
				<div class='simple'>
					<label for='password'>Password: </label>
					<input type='password' id='password' name='password' size='30' />
				</div>
				<div class='simple'>
					<label for='submit'>&nbsp;</label>
					<input type='submit' value='Login' />
				</div>
			</form>
		</div>
	</body>
</html>

<!--
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Arifin Travel - Login Page</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/reset.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/default.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
	<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-1.6.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.easing-1.3.pack.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	</script>
</head>
<body>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$.fancybox({
				'width'					: 'auto',
				'height'				: 'auto',
				'href'					: '<?php echo base_url() ?>admin/login/',
				'modal' 				: true,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'none',
				'easingIn'      : 'easeOutBack',
				'easingOut'     : 'easeInBack',
				'showNavArrows'	: false,
				'scrolling'			: 'no',
				'titleShow'			: false,
			});
		});
	</script>
</body>
</html>
-->
