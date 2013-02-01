<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pencarian Member</title>
<link rel="stylesheet" href="<? echo base_url(); ?>css/general.css" type="text/css" />
<link rel="stylesheet" href="<? echo base_url(); ?>css/table.css" type="text/css" />

<script language="javascript" src="<?php echo base_url(); ?>js/jquery-1.2.3.js"></script>
<script language="javascript" src="<?php echo base_url(); ?>js/jquery.form.js"></script>
<script language="javascript">
// prepare the form when the DOM is ready 
$(document).ready(function() { 
	//$('#tableList').hide();             
    // bind form using ajaxForm 
	//$('#tableList').load('');
    $('#findUser').ajaxForm({ 
        // target identifies the element(s) to update with the server response 
        target: '#tableList', 

        // success identifies the function to invoke when the server response 
        // has been received; here we apply a fade-in effect to the new content 
        success: function() { 
            $('#tableList').fadeIn('slow');             
       } 
    }); 
	});

$(function(){
	$("#ajax_display").ajaxStart(function(){
	$('#tableList').hide();             

		$(this).html('<img alt="" src="<? echo base_url();?>images/wait.gif" /><br />Please Wait ...');
	});
	$("#ajax_display").ajaxSuccess(function(){
   		$(this).html('');
		
 	});
	$("#ajax_display").ajaxError(function(url){
   		alert('jQuery ajax is error ');
 	});
	});
</script>
</head>

<body>
<h3>Pencarian Member</h3>
<hr />
<?php
$attributes = array('class' => 'findNew', 'id' => 'findUser', 'name' => 'findUser' );
 echo form_open('popup/member/index2', $attributes); ?>
<table width="450" cellpadding="2" cellspacing="2" align="center" class="content">
	<tr>
		<td width="86">Berdasarkan</td>
		<td width="278" class="tdspecial2">
		<? echo form_dropdown("filter",$filterList,"ID Member"); ?>
		</td>
	</tr>
	<tr>
		<td>Kata Kunci</td>
		<td class="tdspecial2"><? echo form_input($keyword); ?>
		<span class="tdspecial">
		<?php echo form_submit('submit', 'Find'); ?>
		</span>
      </td>
	</tr>
</table>
<? echo form_close(); ?>
<div id="ajax_display">

</div>
<div id="tableList">


</div>
</body>
</html>
