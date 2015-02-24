<?php

class tpl
{

	function __construct()
	{
		# code...
	}

    public static function alert($type, $message, $closable = true) {

        $alert = '';

        if ($type == 'primary') {
            $alert .= '<div class="alert alert-primary">';
        } elseif ($type == 'success') {
            $alert .= '<div class="alert alert-success">';
        } elseif ($type == 'info') {
            $alert .= '<div class="alert alert-info">';
        } elseif ($type == 'warning') {
            $alert .= '<div class="alert alert-warning">';
        } elseif ($type == 'danger') {
            $alert .= '<div class="alert alert-danger">';
        } else {
            $alert .= '<div class="alert">';
        }

        if ($closable) {
            $alert .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
        }

        if ($type == 'primary') {
            $alert .= '<i class="fa fa-check sign"></i>';
        } elseif ($type == 'success') {
            $alert .= '<i class="fa fa-check sign"></i>';
        } elseif ($type == 'info') {
            $alert .= '<i class="fa fa-info-circle sign"></i>';
        } elseif ($type == 'warning') {
            $alert .= '<i class="fa fa-warning sign"></i>';
        } elseif ($type == 'danger') {
            $alert .= '<i class="fa fa-times-circle sign"></i>';
        }

        $alert .= $message;

        $alert .= '</div>';

        echo $alert;
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