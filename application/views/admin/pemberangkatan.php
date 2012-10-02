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
					report pemberangkatan
					<div class='insert' style='display:block;float:right;position:relative;text-transform:lowercase;width:210px'>
						<form action="<?php echo base_url() ?>admin/pemberangkatan/search" method="post" accept-charset="utf-8" style='float:right;margin:-8px 0'>
							<div style='float:right;'>
								<input type='button' id='search' name='search' value='Filter'>
							</div>
							<div id="filter" style='background:#ccc;border:1px solid #999;display:none;float:right;padding:5px;'>
								<div style="margin:5px;width:640px;">
									<label for="no" style='float:left;margin-top:5px;margin-right:5px;'>no inv</label>
									<input type='text' name="no" value="" style='float:left;margin-right:5px;width:100px'>

									<label for="pesawat" style='float:left;margin-top:5px;margin-right:5px;'>manafist</label>
									<select name="pesawat" style='float:left;margin-right:5px;width:200px'>
									<option value="semua">semua</option>
									
<?php
$query = $this->db->get('pesawat');
foreach($query->result() as $pw) {
echo "<option value='".$pw->id_pesawat."'>".$pw->no." - ".$pw->nama.": ".$pw->jam."</option>";
}
?>

</select>
									<label for="tanggal_sekian0" style='float:left;margin-top:5px;margin-right:5px;'>tgl berangkat</label>
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
									
									<br/><br/>													
									<label for="kota" style='float:left;margin-top:5px;margin-right:5px;'>kota</label>
									<select name="kota" style='float:left;width:120px;margin-right:5px;'>
										<option value="semua">semua</option>
										<?php $num = 1; ?>
										<?php foreach($kota as $kt): ?>
											<?php if($num == 1): ?>
										<option value="<?php echo $kt->nama ?>" selected><?php echo $kt->nama ?></option>
											<?php else: ?>
										<option value="<?php echo $kt->nama ?>"><?php echo $kt->nama ?></option>
											<?php endif; ?>
											<?php $num++ ?>
										<?php endforeach; ?>
									</select>
									<label for="approve" style='float:left;margin-top:5px;margin-right:5px;'>approve</label>
									<input type='checkbox' id='approve' name="approve" style='float:left;margin-right:5px;' onchange='oncekapp()'>
									<input type="hidden" id='approve_submit' name="approve_submit" value="0">
									<input type="submit" name="submit" value="Go">
								</div>
							</div>
						</form>
					</div>
					<div style='clear:both;float:left'>
						<?php if(isset($tanggal_sekian0) || isset($kotayangdituju)): ?>
						<span style='margin-top:-2px; font-size:12px'><font style='color:#09f'>Manafist: 
						<?php echo $manafist ?>
						
						</font>&nbsp;&nbsp;&nbsp;&nbsp; Pemberangkatan tanggal: <?php echo $tanggal_sekian0 ?> kota <?php echo $kotayangdituju ?></span>
						<?php endif; ?>
					</div>
				</caption>
				<thead>
					<tr>
						<th class='no' width="10">No</th>
						<th width="30">No Invoice</th>
						<th width="15">Penumpang</th>
						<th>Kota Asal</th>
						
						<th>Manafist</th>
						<th>Alamat</th>
						<th>Jam</th>
						<th>Biaya</th>
						
					</tr>
				</thead>
				<tbody>
					<?php $num = 1; ?>
					<?php foreach($invoice as $row): ?>
					<tr>
                                                <td width="10"><?php echo $num ?></td>
						<td width="30"><?php echo $row->no ?></td>
						<td width="15"><?php echo $row->user ?></td>
						<td><?php echo $row->kota ?></td>
						
						<td><?php echo $row->no_pesawat." | ".$row->jam_pesawat;  ?></td>
						<td><?php echo $row->alamat ?></td>
						<td><?php echo $row->jam ?></td>
						<td><?php echo number_format($row->biaya,0,",",".") ?></td>
						
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
		
		</div>
		
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
