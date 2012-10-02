<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Arifin Travel - Administrator Page</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/reset.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/admin.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/pagination.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/datePicker.css" media="screen">
	<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-1.6.1.min.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>js/pagination.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.block.UI.min.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>js/nicEdit.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.maskedinput-1.3.min.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.pack.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>js/date.js"></script>
	<!--[if lt IE 7]><script type="text/javascript" src="<?php echo base_url() ?>js/jquery.bgiframe.min.js"></script><![endif]-->
	<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.datePicker.js"></script>
	<script type="text/javascript" charset="utf-8">
		bkLib.onDomLoaded(function() { 
			new nicEditor({
				iconsPath 	: '<?php echo base_url() ?>js/nicEditorIcons.gif',
				buttonList : ['fontSize','fontFamily','fontFormat','bold','italic','underline','left','center','right','justify','ol','ul','strikeThrough','subscript','superscript','xhtml','removeFormat','indent','outdent','hr','link','unlink','forecolor','backcolor'],
			}).panelInstance('isi');
		});
		$(document).ready(function() {
			$('#insert').validate();
			$('#jam').mask('99:99');
			$('#admin-left table tr:odd').css({background:'#fff'});
			$('#admin-left table tr:even').css({background:'#eee'});
			$('.date-pick').datePicker();
		});
	</script>
</head>
<body>
	<div id="container">
		<div id="header">
			<img src="<?php echo base_url() ?>images/logo.gif" alt="">
			<div id='menu'>
				<ul>
					<li><a href="<?php echo base_url() ?>admin/">dashboard</a></li>
					<li><a href="<?php echo base_url() ?>admin/invoice/">report antar</a></li>
					<li><a href="<?php echo base_url() ?>admin/invoicej/">report jemput</a></li>
					<li><a href="<?php echo base_url() ?>admin/pemberangkatan/">report pemberangkatan</a></li>
					<li><a href="<?php echo base_url() ?>admin/penukaran/">report penukaran</a></li>
					<li><a href="<?php echo base_url() ?>admin/tiket/">report tiket</a></li>
					<li><a href="<?php echo base_url() ?>admin/rental/">report persewaan</a></li>
				</ul>
				<div class='clear'></div>
			</div><!--#menu-->
		</div><!--#header-->
		<div class='clear'></div>
