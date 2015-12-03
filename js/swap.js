/*
SOURCES, ATTRIBUTIONS, WHO DID WHAT:
Adam: Created file
*/

$(document).ready(function() {
			$.ajax({
				type: "GET",
				url: "php/swapuser.php",
				success: function(data) {
					$("#swap-login").html(data);
				}
			})
		});