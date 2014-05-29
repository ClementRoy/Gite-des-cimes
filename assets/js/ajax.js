$(document).ready(function(){


	if (typeof $('#form-enfant-structure-select').val() != "undefined") {
		var contact_id = $('#form-enfant-contact-select').val();
		var structure_id = $('#form-enfant-structure-select').val();
		$.ajax({
			type: "GET",
			url: "/ajax/get_contact/id/"+structure_id,
			data: {
			},
			success: function(data){
				$('#form-enfant-contact-select').html('');
				if(data != ''){
					var strArray = data.split("#");
					if(strArray[0] != null) {
						$.each(strArray,function( index, value ) {
							var elemArray = value.split("|");
							if (elemArray['1'] != contact_id) {
								$('#form-enfant-contact-select').append("<option value='" + elemArray['1'] + "'>" + elemArray['0'] + "</option>");
							} else {
								$('#form-enfant-contact-select').append("<option value='" + elemArray['1'] + "' selected=\"selected\">" + elemArray['0'] + "</option>");
							}
							
						});
					} else {
						//$('#form-enfant-contact-select').html(html);
					}
				}
				else {
					$('#form-enfant-contact-select').html("<option value='default'>Aucun contact associé pour le moment</option>");
				}

			}
		});
	}

	$('#form-enfant-structure-select').on('change', function(){
		//$('#dpt_etude').prev('span').hide('fast');
		$.ajax({
			type: "GET",
			url: "/ajax/get_contact/id/"+$(this).val(),
			data: {
			},
			success: function(data){
				$('#form-enfant-contact-select').html('');
				if(data != ''){
					//$('#form-enfant-contact-select').html('');
					var strArray = data.split("#");
					//console.log(data);
					//strArray.splice(0,1);
					if(strArray[0] != null) {

						//$('#form-enfant-contact-select').html(html);
						$.each(strArray,function( index, value ) {
							var elemArray = value.split("|");
							$('#form-enfant-contact-select').append("<option value='" + elemArray['1'] + "'>" + elemArray['0'] + "</option>");
						});
					}
				}
				else {
					$('#form-enfant-contact-select').html("<option value='default'>Aucun contact associé pour le moment</option>");
				}

			}
		});
	});



});