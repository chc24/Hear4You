$(document).ready(function() {
			$.ajax({
				type: "GET",
				url: "php/swapuser.php",
				success: function(data) {
					$("#swap-login").html(data);
				}
			})
		});