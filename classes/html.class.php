<?php 

class html
{

    public static function input($type, $id, $class = array(), $value, $tooltip, $required = 'false', $prefix = false, $suffix = false){


		switch ($type) {
		    case "text":
				$input = '<div class="field-box row">
	                        <label class="col-md-2" for="'.$id.'">Prénom</label>
	                        <div class="col-md-5">
	                            <input id="'.$id.'" name="'.$id.'" class="form-control" type="text" data-toggle="tooltip" title="'.$tooltip.'" parsley-required="'.$required.'">
	                        </div>
	                    </div>';
		    break;
		    case "password":
		        $input = '';
		    break;
		    case "date":
		        $input = '';
		    break;
		    case "phone":
		        $input = '';
		    break;
		    case "radio":
		        $input = '';
		    break;
		    case "email":
		        $input = '';
		    break;
		    case "hidden":
		        $input = '';
		    break;
		    case "upload":
		    	$input = '';
		    break;
		}

    	echo $input;
        //return $tel;
    }


    public static function textarea($id, $label, $title = '', $rows = '4'){

        $output = '<div class="field-box row">
                    <label class="col-md-2" for="'.$id.'">'.$label.'</label>
                    <div class="col-md-4 col-sm-5">
                        <textarea id="'.$id.'" name="'.$id.'" class="form-control" rows="'.$rows.'" data-toggle="tooltip" title="'.$title.'"></textarea>
                    </div>
                </div>';
        echo $output;
    }

    public static function select(){

    }

    public static function submit($name, $value){

        $output = '<div class="field-box actions">
                    <div class="col-md-6  col-md-offset-2">
                        <input type="submit" class="btn btn-primary" name="'.$name.'" value="'.$value.'">
                        <span>OU</span>
                        <a href="'.$_SERVER['HTTP_REFERER'].'" class="reset">Annuler</a>
                    </div>
                </div>';

        echo $output;

    }

    public static function button(){

    }



    public static function mailto($email, $text = false){
    	echo '<a href="mailto:'.$email.'">'.$email.'</a>';
    }

    public static function link($url, $text = false){
    	echo '<a href="'.$url.'">'.$url.'</a>';
    }






    // textarea
    // input text
    // input password
    // input date
    // input phone
    // input email
    // input hidden
    // input checkbox
    // select
    // input radio
    // button
    // input submit

}

?>