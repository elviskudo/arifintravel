<?php if($this->session->userdata('email')): ?>

<?php echo $this->load->view('admin/include/header'); ?>
<link rel="stylesheet" type="text/css" media="all" href="<? echo base_url();?>css/calendar/calendar-win2k-cold-1.css" title="win2k-1" />
<script type="text/javascript" src="<? echo base_url();?>js/calendar/calendar.js"></script>
<script type="text/javascript" src="<? echo base_url();?>js/calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="<? echo base_url();?>js/calendar/calendar-setup.js"></script>
<div id="content">
	<div id="admin-left">
		<div id='ajax-content'>
			<table id='blog'>
				<caption>
					report penukaran
					<div class='insert' style='display:block;float:right;position:relative;text-transform:lowercase;width:210px'>
						<form action="<?php echo base_url() ?>admin/penukaran/search" method="post" accept-charset="utf-8" style='float:right;margin:-8px 0'>
							<div style='float:right;'>
								<input type='button' id='search' name='search' value='Filter'>
							</div>
							<div id="filter" style='background:#ccc;border:1px solid #999;display:none;float:right;padding:5px;'>
								<div style="margin:5px;width:640px;">
									<label for="no" style='float:left;margin-top:5px;margin-right:5px;'>No. Invoice</label>
									<input type='text' name="no" value="" style='float:left;margin-right:5px;width:75px'>
									
									<label for="tanggal_sekian0" style='float:left;margin-top:5px;margin-right:5px;'>tanggal</label>
									<input type='text' id="tanggal0" name="tanggal_sekian0" value="<?php echo date("d/m/Y") ?>" style='float:left;width:70px;margin-right:5px;'>
									<?php 
echo " 
<img src=\"".base_url()."images/ew_calendar.gif\" id=\"cx_tanggal0\" alt=\"Pick a Date\" style=\"cursor:pointer;cursor:hand;float:left;margin-top:5px;margin-right:5px;\"> 
<script type=\"text/javascript\">
Calendar.setup(
{
inputField : \"tanggal0\", // ID of the input field
ifFormat : \"%d/%m/%Y\", // the date format
button : \"cx_tanggal0\" // ID of the button
}
);
</script>";?>
									
									<label for="tanggal_sekian1" style='float:left;margin-top:5px;margin-right:5px;'>s/d</label>
									<input type='text' id='tanggal1' name="tanggal_sekian1" value="<?php echo date('d/m/Y') ?>" style='float:left;width:70px;margin-right:5px;'>
<?php 
echo " 
<img src=\"".base_url()."images/ew_calendar.gif\" id=\"cx_tanggal1\" alt=\"Pick a Date\" style=\"cursor:pointer;cursor:hand;float:left;margin-top:5px;margin-right:5px;\"> 
<script type=\"text/javascript\">
Calendar.setup(
{
inputField : \"tanggal1\", // ID of the input field
ifFormat : \"%d/%m/%Y\", // the date format
button : \"cx_tanggal1\" // ID of the button
}
);
</script>";?>													
									<br />
									<br />
									<label for="kota" style='float:left;margin-top:5px;margin-right:5px;'>Cabang</label>
									<select name="kota" style='float:left;width:120px;margin-right:5px;'>
										<option value="semua" selected>semua</option>
										<?php $num = 1; ?>
										<?php foreach($kota as $kt): ?>
											<?php if($num == 1): ?>
										<option value="<?php echo $kt->nama ?>"><?php echo $kt->nama ?></option>
											<?php else: ?>
										<option value="<?php echo $kt->nama ?>"><?php echo $kt->nama ?></option>
											<?php endif; ?>
											<?php $num++ ?>
										<?php endforeach; ?>
									</select>
									<label for="no" style='float:left;margin-top:5px;margin-right:5px;'>Jenis</label>
									<select id='matauang' name="jenis" class="required">
							<option value="semua">Semua</option>
							<option value="JUAL">JUAL</option>
							<option value="BELI">BELI</option>	
							</select>
									<span style="text-align:right; margin-right:30px">
									<input type="submit" name="submit" value="Go"></span>
								</div>
							</div>
						</form>
					</div>
					<div style='clear:both;float:left'>
						<?php if(isset($tanggal_sekian0) || isset($tanggal_sekian1) || isset($mata_uang)): ?>
						<span style='margin-top:-2px;'><font style='color:#09f; font-size:12px'>Cabang Pemesan: 
						<?php echo $this->input->post('kota'); ?>
						
						</font>&nbsp;&nbsp;&nbsp;&nbsp; <font style="font-size:12px">Dari tanggal: <?php echo $tanggal_sekian0 ?> s/d <?php echo $tanggal_sekian1 ?> </font></span>
						<?php endif; ?>
					</div>
				</caption>
				<thead>
					<tr>
						<th class='no'>No</th>
						<th>No. Invoice</th>
						<th>Tgl Penukaran</th>
						<th>Cabang</th>
						<th>Jml Penukaran</th>
						<th>Jenis</th>
						<th>Total</th>
						<th>Pemesan</th>
						<th class='action'>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $num = 1; ?>
					<?php foreach($penukaran as $row): ?>
					<tr>
						<td><?php echo $num ?></td>
						<td><?php echo $row->id_penukaran ?></td>
						<td><?php echo $row->tanggal_penukaran ?></td>
						<td><?php echo $row->cabang_pemesan ?></td>
						<td><?php echo $row->jumlah_penukaran ?></td>
						<td><?php echo $row->jenis ?></td>
						<td><?php echo number_format($row->total,0,",",".") ?></td>
						<td><?php echo $row->pemesan ?></td>
						<td>
							<a href="<?php echo base_url() ?>admin/penukaran/printr/<?php echo $row->id_penukaran ?>" target='_blank'>
								<img src="<?php echo base_url() ?>images/check.gif" alt="View Data" title="View Data">
							</a>
							
							<a href="<?php echo base_url() ?>admin/penukaran/delete_penukaran/<?php echo $row->id_penukaran ?>" onclick="return confirm('Apakah kamu yakin untuk menghapus invoice ini?')">
								<img src="<?php echo base_url() ?>images/delete.gif" alt="Hapus Data" title="Hapus Data">
							</a>
						</td>
					</tr>
					<?php $num++; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
				<?php if(!$this->session->userdata('search')): ?>
			<!--<ul id="pagination-digg" class='ajax-page' style='margin-bottom:40px;'>
				<?php //echo $page_link; ?>
			</ul>-->
				<?php endif; ?>
				<?php $this->session->unset_userdata('search'); ?>
			<div style='float:right;font-weight:bold'> total biaya: <?php echo number_format($totalbiaya,0,",",".") ?></div>
			<div class='clear'></div>
			
		</div>
		
		<?php if($this->session->userdata('error')):?>
		<div class='error'><?php echo $this->session->userdata('error'); ?></div>
		<?php endif; ?>
		
		<div class='clear'></div>
	</div><!--#left-->
	
	<script type="text/javascript" charset="utf-8">
		function oncekapp() {
			var approve = document.getElementById('approve');
			var approve_submit = document.getElementById('approve_submit');
			if(approve.checked == true) {
				approve_submit.value = 1;
			} else {
				approve_submit.value = 0;
			}
		}
		$(document).ready(function() {
			$('#search').toggle(function() {
				$('#filter, #filter label').css({display:'block'});
			},function() {
				$('#filter, #filter label').css({display:'none'});
			});
		});
	</script>

<?php echo $this->load->view('admin/include/right'); ?>

</div><!--#content-->
<div class='clear'></div>

<?php echo $this->load->view('admin/include/footer'); ?>

<?php else: ?>

<?php echo $this->load->view('admin/include/login'); ?>

<?php endif; ?>
