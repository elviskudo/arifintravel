	<div class='clear'></div>
	
	<div class='footer'>
		<div id="footer">
			Copyright &copy; 2011, Arifin Tours and Travel.
		</div><!--#footer-->
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#emailn').bind('blur', function() {
				if($(this).val() != '') {
					$.ajax({
						type: 'GET',
						url: '<?php echo base_url() ?>login/validate_email',
						data: 'email='+$(this).val(),
						cache: false,
						success: function(data) {
							if(data == 'true') {
								$('#email_registered').css('display', 'block').attr('src', '<?php echo base_url() ?>images/delete.gif');
								$('#is_email_registered').val(1);
							} else {
								$('#email_registered').css('display', 'block').attr('src', '<?php echo base_url() ?>images/check.gif');
								$('#is_email_registered').val(0);
							}
						}
					});
					return false;
				}
			});
		});
	</script>

</body>
</html>
