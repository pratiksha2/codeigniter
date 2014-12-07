<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Date Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/date_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Matrimony Date String
 *
 * Returns a date formatted according to the submitted standard.
 *
 * @access	public
 * @param	string	the chosen format
 * @param	date string
 * @return	string
 */
if ( ! function_exists('matrimony_date'))
{
	function matrimony_date( $dateString = '')
	{
		if($dateString==''){
			return;
		}
		$time = human_to_unix($dateString);
		return date('l, F d, Y', $time);
	}
}

if ( ! function_exists('matrimony_time'))
{
	function matrimony_time( $timeString = '')
	{
		if($timeString==''){
			return;
		}
		$time = human_to_unix($timeString);
		return date('h:i A', $time);
	}
}