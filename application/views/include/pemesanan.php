<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Print Invoice Pemesanan Tiket dengan No <?php echo $no ?></title>
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
		<?php echo $tanggal ?>
	</div>
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold">Official Site of <b>arifintravel.com</b></td>
			<td align="right" style="text-align:right">
			<span style="font-family:Arial, Helvetica, sans-serif; font-size:14px;font-weight:bold;"><b>INVOICE TIKET PENERBANGAN</b></span><br>
			Nomor Invoice : <b style='font-weight:bold'><?php echo $no ?></b><br>
			Maskapai Penerbangan : <b style='font-weight:bold'><?php echo $maskapai ?></b><br>
			Kode Booking : <b style='font-weight:bold'><?php echo $kodeb ?></b><br>
		
			</td>
		</tr>
	</table>
	
	<fieldset style='float:left;font-size:10px;line-height:12px;width:40%;margin-right:1%;'>
		<legend style='font-weight:bold;padding:0 20px;text-transform:uppercase'>Kantor Cabang</legend>
		<div style='float:left;margin-right:20px;overflow:hidden;width:350px'>
Jl. Raya Golokan, Sidayu, Gresik Telp. 031-3940728<br>
Jl. RA Kartini No.102A, Gresik, Telp. 031-3990733<br>
Ds. Legundi, Paciran, Lamongan, Telp. 0322-662911<br>
Jl. Senduro Utara, Kab. Lumajang Telp. 0334-610532	
		</div>
	</fieldset>
	<fieldset style='text-align:left;font-size:10px;line-height:12px'>
		<legend style='font-weight:bold;padding:0 20px;text-transform:uppercase'>Detail Pemesanan</legend>
		Dari : <b style='font-weight:bold'><?php echo $dari; ?></b><br>
		Tujuan : <b style='font-weight:bold'><?php echo $tujuan; ?></b><br>
		Tanggal Berangkat : <b style='font-weight:bold'><?php echo $tgl_berangkat ?></b><br>
	
		
	</fieldset>
	
	<table border="1" cellspacing="5" cellpadding="5">
		<tr class='head'>
			<th>Nama</th>
			<th>No. Identitas</th>
			<th>Alamat</th>
			<th>Telpon</th>
			<th>Jmlh Orang</th>
			<th>Biaya</th>
		</tr>
		<tr>
			<td><?php echo $nama ?></td>
			<td><?php echo $pengenal ?></td>
			<td><?php echo $alamat ?></td>
			<td><?php echo $telp ?></td>
			<td><?php echo $orang ?></td>
			<td style='text-align:right'><?php echo str_replace(',','.',number_format($biaya)) ?></td>
		</tr>
		
		<tr>
			<td colspan="5" class='bold'>Total :</td>
			<td style='text-align:right' class='bold'>Rp. <?php echo str_replace(',','.',number_format($biaya)) ?></td>
		</tr>
		<tr>
			<td colspan="5" class='bold'>
				<b>Catatan :</b><br>
				<p style='font-weight:normal;margin-left:20px;'>
				
							<?php echo $catatan ?><br>

				</p>
			</td>
		</tr>
	</table>
	<div class='clear'></div>
	
	<div class='left' style='font-size:10px;line-height:12px'>
		<p>
			Keterangan:
		</p>
		Jika anda membatalkan Hub. 081 332 590 550<br>
		Jika anda kurang puas dengan pelayanan kami Hub. 081 553 600 005
	</div>
	<div class="right">
		Petugas<br><br>
		( ________________________ )
	</div>
</div><!--#invoice-->
	
</body>
</html>
