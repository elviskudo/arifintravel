<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Print Invoice Persewaan dengan No <?php echo $no ?></title>
	<link rel="stylesheet" href="<?php echo base_url() ?>css/reset.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>css/default.css">
	<style type="text/css" media="print">
		div#print { display:none; }
	</style>
</head>
<body>

<div id="invoice">
	<div id='print' style='float:right;margin-bottom:10px'>
		<input type="button" name="print" value="Print" onclick='window.print()'>
	</div>
	<div class="clear"></div>
	
	<div id='pusat'>
		<?php echo date("d-m-Y"); ?>
	</div>
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold">Official Site of <b>arifintravel.com</b></td>
			<td align="right" style="text-align:right">
			<span style="font-family:Arial, Helvetica, sans-serif; font-size:14px;font-weight:bold;"><b>INVOICE RENTAL MOBIL</b></span><br>
			Nomor Invoice : <b style='font-weight:bold'><?php echo $no; ?></b><br>
		
			</td>
		</tr>
	</table>
		
	<fieldset style='float:left;font-size:10px;line-height:12px;width:40%;margin-right:1%;'>
		<legend style='font-weight:bold;padding:0 20px;text-transform:uppercase'>Kantor Cabang</legend>
		<div style='float:left;margin-right:20px;overflow:hidden;width:350px'>
Jl. R.A.Kartini No. 102 A Gresik Telp. 031-3990733<br>
Ds. Prupuh Kec. Panceng Gresik Telp. 031-3941240<br>
Ds. Legundi Kec. Paciran Lamongan Telp. 0322-662911<br>
Ds. Solokuro Kec. Solokuro Kab. Lamongan Telp. 0322-662818<br>
Jl. Senduro Utara Kec. Senduro Kab. Lumajang Telp. 0334-610446
		</div>
	</fieldset>
	<fieldset style='text-align:left;font-size:10px;line-height:12px'>
		<legend style='font-weight:bold;padding:0 20px;text-transform:uppercase'>Detail Pemesanan</legend>
		Nama Pemesan : <b style='font-weight:bold'><?php echo $nama ?></b><br>
		Alamat : <b style='font-weight:bold'><?php echo $alamat ?></b><br>
		No. Identitas : <b style='font-weight:bold'><?php echo $no_id ?></b><br>
		Telpon : <b style='font-weight:bold'><?php echo $telp ?></b><br>
		Dari Kota : <b style='font-weight:bold'><?php echo $kota ?></b><br>
	</fieldset>
	
	<table border="1" cellspacing="1" cellpadding="1">
		<tr class='head'>
			<th>Tujuan</th>
			<th>Tgl Mulai</th>
			<th>Tgl Akhir</th>
			<th>Mobil</th>
			<th>Biaya</th>
		</tr>
		
		<tr>
			<td><?php echo $tujuan ?></td>
			<td><?php echo $tgl_mulai ?></td>
			<td><?php echo $tgl_akhir ?></td>
			<td><?php echo $jenis.' - '.$plat ?></td>
			<td style='text-align:right'><?php echo str_replace(',','.',number_format($tarif)) ?></td>
		</tr>
		
		<tr>
			<td colspan="4" class='bold'>Total :</td>
			<td class='bold' style='color:#f00;text-align:right'>
				<?php
				echo str_replace(',','.',number_format($tarif))
				?>
			</td>
		</tr>
		<tr>
			<td colspan="5" class='bold'>
				<b>Jaminan :</b>	
					<?php echo $jaminan; ?><br />
				<b>Catatan :</b><br>
				<p style='font-weight:normal;margin-left:20px;'>
					<?php echo $catatan; ?>
				</p>
			</td>
		</tr>
	</table>
	<div class='clear'></div>
	
	<div class='left' style='font-size:10px;line-height:8px'>
		<p>
			Keterangan:
		</p>
		<br />
		Jika anda membatalkan Hub. 081 332 590 550<br>
		Jika anda kurang puas dengan pelayanan kami Hub. 081 553 600 005
	</div>
	<div class="right">
		Petugas<br>
		<br>
		( __________________ )
	</div>
</div><!--#invoice-->
	
</body>
</html>