$(document).ready(function(){



	$('#form-enfant-structure-select').on('change', function(){
		//$('#dpt_etude').prev('span').hide('fast');
		$.ajax({
			type: "GET",
			url: "/ajax/get_contact/id/"+$(this).val(),
			data: {
			},
			success: function(data){
				//console.log(data);
				if(data != "no_result"){
					villeVisible = true;
					var strArray = data.split("|");
					strArray.splice(0,1)
					if(strArray[0] != null) {
						$('#ville_etude').html("").show();
						$('#ville_etude').append("<option value='default'>Choisissez votre ville d'études</option>");
						$('#etablissement_etude').html("<option value='default'>Choisissez votre établissement d'études</option>");
						for(var cpt=0; cpt<=strArray.length-1; cpt++){
							$('#ville_etude').append("<option id='" + strArray[cpt] + "'>" + strArray[cpt] + "</option>");
						}
					} else {
						villeVisible = false;
						etabVisible = false
						$('#ville_etude').html("<option value='default'>Choisissez votre ville d'études</option>");
						$('#etablissement_etude').html("<option value='default'>Choisissez votre établissement d'études</option>");
					}
				}

			}
		});
	});



});