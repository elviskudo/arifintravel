<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Print Invoice Pengantaran dengan No <?php echo $no ?></title>
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
			<span style="font-family:Arial, Helvetica, sans-serif; font-size:14px;font-weight:bold;"><b>INVOICE PENGANTARAN</b></span><br>
			Nomor Invoice : <b style='font-weight:bold'><?php echo $no ?></b><br>
		Nama Pesawat : <b style='font-weight:bold'><?php echo $no_pesawat ?> - <?php echo $nama_pesawat ?></b><br>
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
		Tanggal Pengantaran : <b style='font-weight:bold'><?php echo $waktu ?></b><br>
		Jam Pengantaran : <b style='font-weight:bold'><?php echo $jam ?></b><br>
		Nama Pemesan : <b style='font-weight:bold'><?php echo $nama ?></b><br>
		Alamat : <b style='font-weight:bold'><?php echo $alamat ?></b><br>
		Telpon : <b style='font-weight:bold'><?php echo $telpon ?></b><br>
		Email : <b style='font-weight:bold'><?php echo $email ?></b><br>
		Dari Kota : <b style='font-weight:bold'><?php echo $kota ?></b><br>
	</fieldset>
	
	<table border="1" cellspacing="1" cellpadding="1">
		<tr class='head'>
			<th>Nama</th>
			<th>Alamat Asal</th>
			<th>Telpon</th>
			<th>Biaya</th>
		</tr>
		<?php foreach($penumpang as $pn): ?>
		<tr>
			<td><?php echo $pn->penumpang ?></td>
			<td><?php echo $pn->alamat ?></td>
			<td><?php echo $pn->telpon ?></td>
			<td style='text-align:right'><?php echo str_replace(',','.',number_format($pn->biaya)) ?></td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="3" class='bold'>Jasa Pengurusan :</td>
			<td style='font-weight:normal;text-align:right'>
				<?php	if($jasa == '1'): ?>
				25.000
				<?php else: ?>
				0
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td colspan="3" class='bold'>Total :</td>
			<td class='bold' style='color:#f00;text-align:right'>
				<?php
				foreach($penumpang as $by) {
					$biaya += $by->biaya;
				}
				if($jasa == '1')				
					echo str_replace(',', '.', number_format($biaya + 25000));
				else
					echo str_replace(',', '.', number_format($biaya));
				?>
			</td>
		</tr>
		<tr>
			<td colspan="4" class='bold'>
				<b>Catatan :</b><br>
				<p style='font-weight:normal;margin-left:20px;'>
					<?php foreach($penumpang as $ct): ?>
						<?php if($ct->catatan): ?>
							<?php echo $ct->penumpang.': '.$ct->catatan ?><br>
						<?php endif; ?>
					<?php endforeach; ?>
				</p>
			</td>
		</tr>
	</table>
	<div class='clear'></div>
	
	<div class='left' style='font-size:10px;line-height:8px'>
		<p>
			Keterangan:
		</p>
		Untuk Tujuan Tuban dan Bojonegoro minimal 3 orang Rp. 100.000,-<br>
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