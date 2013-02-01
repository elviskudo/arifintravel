<?php echo $this->load->view('include/header'); ?>

	<?php echo $this->load->view('include/menu'); ?>
	
	<div class='error'>
		Terima Kasih telah melakukan pemesanan melalui ArifinTravel.com. Invoice Pemesanan telah tersimpan dan terkirim ke email anda.<br/>
		atau klik tombol <b style='font-weight:bold'>Cetak!</b> untuk mencetak invoice pesanan anda<br/>
	</div>
	
	<div class='info'>
	<?php
	$atts = array(
    'width'      => '800',
    'height'     => '600',
    'scrollbars' => 'yes',
    'status'     => 'no',
    'resizable'  => 'no',
    'screenx'    => '10',
    'screeny'    => '10'
  );
	echo anchor_popup(base_url().'invoicej/printr/'.$this->session->userdata('no_invoicej'), 'Cetak!', $atts);
	?>
	</div>
	<?php echo $this->load->view('include/invoicej'); ?>
	</div><!--#content-->

<?php echo $this->load->view('include/footer'); ?>