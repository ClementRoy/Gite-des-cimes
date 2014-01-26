$(document).ready(function(){


	$('#form-enfant-structure-select').on('change', function(){
		//$('#dpt_etude').prev('span').hide('fast');
		$.ajax({
			type: "GET",
			url: "/ajax/get_contact/id/"+$(this).val(),
			data: {
			},
			success: function(data){
				if(data != ''){
					//$('#form-enfant-contact-select').html('');
					var strArray = data.split("#");
					//console.log(data);
					//strArray.splice(0,1);
					html = $('#form-enfant-contact-select').html();
					if(strArray[0] != null) {

						//$('#form-enfant-contact-select').html(html);
						$.each(strArray,function( index, value ) {
							var elemArray = value.split("|");
							$('#form-enfant-contact-select').append("<option value='" + elemArray['1'] + "'>" + elemArray['0'] + "</option>");
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
	});



});