<?php 

class form
{

    public static function input($type, $id, $tooltip, $required = 'false'){

    	if($type == "text"){
			echo '<div class="field-box row">
                        <label class="col-md-2" for="'.$id.'">Prénom</label>
                        <div class="col-md-5">
                            <input id="'.$id.'" name="'.$id.'" class="form-control" type="text" data-toggle="tooltip" title="'.$tooltip.'" parsley-required="'.$required.'">
                        </div>
                    </div>';
    	}

        //return $tel;
    }


}

?>