<script type="text/javascript">
	function onCekUser(){
	var pilihUser = document.forms['userResult'];
	var order = window.opener.document.forms['persewaan'];
	order.elements['id_mobil'].value = pilihUser.elements['id_mobil'].value;
	order.elements['jenis'].value = pilihUser.elements['jenis'].value + ' | ' + pilihUser.elements['warna'].value;
	order.elements['plat'].value = pilihUser.elements['plat'].value;
	
	window.close();
	}
	
	function onClickUser(_kunci, _kunci2, _kunci3, _kunci4){
	document.forms['userResult'].elements['id_mobil'].value = _kunci;
	document.forms['userResult'].elements['jenis'].value = _kunci2;
	document.forms['userResult'].elements['warna'].value = _kunci3;
	document.forms['userResult'].elements['plat'].value = _kunci4;
	
	}
</script>
<?php
$attributes = array('id' => 'userResult', 'name' => 'userResult' );
 echo form_open('popup/member/index2', $attributes); ?>
<table width="450" cellpadding="0" cellspacing="0" class="content" align="center" border="1" style="border-collapse: collapse" bordercolor="#C0C0C0">
  <!--DWLayoutTable-->
  <tr class="table-head"> 
    <td width="17" height="20" valign="top" align="center">x</td>
    <td width="110" style="padding-left:10px">Jenis</td>
    <td width="170" style="padding-left:10px">Plat Nomor</td>
    <td width="75" style="padding-left:10px">Warna</td>
	
  </tr>
<?php
   if ($total > 0) {
   foreach ($results->result() as $row):
	echo "
			<tr>
			<td><input type=radio name=userSelect onClick=\"onClickUser('".$row->id_mobil."','".$row->jenis."','".$row->warna."','".$row->plat."')\"></td>
			<td style=\"padding-left:10px\">".$row->jenis."</td>
			<td style=\"padding-left:10px\">".$row->plat."</td>
			<td style=\"padding-left:10px\">".$row->warna."</td>
			
			</tr>
		";
	endforeach;
	?>
			<tr>
			<td colspan="4" class="tdspecial3"> 
			
        	<input type="hidden" name="id_mobil" value="">
			<input type="hidden" name="jenis" value="">
			<input type="hidden" name="warna" value="">
			<input type="hidden" name="plat" value="">
			
	
        	<input type="button" name="chose" value="Select" onClick="onCekUser();">
      	
	  		</td>
		</tr>

	<?
	} else {
		echo "<tr><td colspan=5 style='color:red;' align=center><br/>Mobil Tidak Ditemukan !<br/></td></tr>";
	}
?>
</table>
<? echo form_close();?>