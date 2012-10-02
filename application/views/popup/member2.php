<script type="text/javascript">
	function onCekUser(){
	var pilihUser = document.forms['userResult'];
	var order = window.opener.document.forms['rental'];
	order.elements['id_member'].value = pilihUser.elements['id_member'].value;
	order.elements['nama'].value = pilihUser.elements['nama'].value;
	order.elements['alamat'].value = pilihUser.elements['alamat'].value;
	order.elements['no_id'].value = pilihUser.elements['no_id'].value;
	order.elements['telp'].value = pilihUser.elements['telp'].value;
	
	window.close();
	}
	
	function onClickUser(_kunci, _kunci2, _kunci3, _kunci4, _kunci5 ){
	document.forms['userResult'].elements['id_member'].value = _kunci;
	document.forms['userResult'].elements['nama'].value = _kunci2;
	document.forms['userResult'].elements['alamat'].value = _kunci3;
	document.forms['userResult'].elements['no_id'].value = _kunci4;
	document.forms['userResult'].elements['telp'].value = _kunci5;
	}
</script>
<?php
$attributes = array('id' => 'userResult', 'name' => 'userResult' );
 echo form_open('popup/member/index2', $attributes); ?>
<table width="450" cellpadding="0" cellspacing="0" class="content" align="center" border="1" style="border-collapse: collapse" bordercolor="#C0C0C0">
  <!--DWLayoutTable-->
  <tr class="table-head"> 
    <td width="17" height="20" valign="top" align="center">x</td>
    <td width="110" style="padding-left:10px">ID</td>
    <td width="170" style="padding-left:10px">Nama</td>
    <td width="150" style="padding-left:10px">Alamat</td>
  </tr>
<?php
   if ($total > 0) {
   foreach ($results->result() as $row):
	echo "
			<tr>
			<td><input type=radio name=userSelect onClick=\"onClickUser('".$row->id_member."','".$row->nama."','".$row->alamat."','".$row->no_identitas."','".$row->telp."')\"></td>
			<td style=\"padding-left:10px\">".$row->id_member."</td>
			<td style=\"padding-left:10px\">".$row->nama."</td>
			<td style=\"padding-left:10px\">".$row->alamat."</td>
			</tr>
		";
	endforeach;
	?>
			<tr>
			<td colspan="4" class="tdspecial3"> 
			
        	<input type="hidden" name="id_member" value="">
			<input type="hidden" name="nama" value="">
			<input type="hidden" name="alamat" value="">
			<input type="hidden" name="no_id" value="">
			<input type="hidden" name="telp" value="">
	
        	<input type="button" name="chose" value="Select" onClick="onCekUser();">
      	
	  		</td>
		</tr>

	<?
	} else {
		echo "<tr><td colspan=5 style='color:red;' align=center><br/>Member Tidak Ditemukan !<br/></td></tr>";
	}
?>
</table>
<? echo form_close();?>