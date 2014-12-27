$(document).ready(

	function () {

		$("#bed_number").on("change", function () {

										$.ajax({

										  url: 'bedNumberController.php',
										  type: 'GET',
										  dataType: 'json',
										  data: {
										  	"bedNumber": $("#bed_number").val(),
										  	"bedTaken": false
										  },

										  success: function(data, textStatus, jqXHR) {

										  	if (data['bedTaken']) {
										  		$("label[for=\"bed_number\"]").html("Bed not available");
										  		$("#submit_new_patient").attr('disabled', 'disabled');
										  	}else {
										  		$("label[for=\"bed_number\"]").html("Bed available");
										  		$("#submit_new_patient").removeAttr('disabled');
										  	}

										  },

										  error: function(jqXHR, textStatus, errorThrown) {								  	
											$("label[for=\"bed_number\"]").html("In the function, status: " + textStatus + ". Error: " + errorThrown);  	
										  }

										});

									})
	}
);