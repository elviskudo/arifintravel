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
    <td width="17" height="20" valign="top" align="center">


			
Data Member <font style="color:red"><?php echo $id_member;?></font> Berhasil Ditambahkan
        	<input type="hidden" name="id_member" value="<?php echo $id_member;?>">
			<input type="hidden" name="nama" value="<?php echo $nama;?>">
			<input type="hidden" name="alamat" value="<?php echo $alamat;?>">
			<input type="hidden" name="no_id" value="<?php echo $no_id;?>">
			<input type="hidden" name="telp" value="<?php echo $telp;?>">


        	<input type="button" name="chose" value="OK" onClick="onCekUser();">
      	
	  		</td>
		</tr>

</table>
<?php echo form_close();?>