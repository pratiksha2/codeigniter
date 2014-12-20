<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('set_default'))
{
	function set_default( $value = NULL)
	{
		if(empty($value) && !is_numeric($value)){
			return 'Not Available';
		}
		return $value;
	}
}

if ( ! function_exists('set_default_blank'))
{
	function set_default_blank( $value = NULL)
	{
		if(empty($value) && !is_numeric($value)){
			return '';
		}
		return $value;
	}
}