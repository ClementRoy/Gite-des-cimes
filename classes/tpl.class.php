<?php

class tpl
{

	function __construct()
	{
		# code...
	}


	public static function component($component, $params = false, $content = '') {
        $self_closers = array('input','img','hr','br','meta','link');
        $is_self_closers = 0;

        $output = '';

        foreach ($self_closers as $el) {
            if ($component == $el) {
                $is_self_closers++;
            }
        }
        $output .= '<'.$component.' ';

        if ($params) {
            foreach ($params as $param => $value) {
                $output .= ' '.$param.'="'.$value.'"';
            }
        }
        $output .= '>';

        if (!$is_self_closers) {
            $output .= $content.'</'.$component.'>';
        } else {
            $output .= ' />';
        }       
        echo $output;
	}

}

?>