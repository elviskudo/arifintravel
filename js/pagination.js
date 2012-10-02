function showBusy() {
	$('#ajax-content').block();
}
function updatePage(html) {
	$('#ajax-content').html(html);
}
$(document).ready(function() {
	$('#pagination-digg > li a').live('click', function(eve) {
		eve.preventDefault();
		var link = $(this).attr('href');
		$.ajax({
			url: link,
			type: 'GET',
			dataType: 'html',
			beforeSend: function() {
				showBusy();
			},
			success: function(html) {
				updatePage(html);
			}
		});
	});
});