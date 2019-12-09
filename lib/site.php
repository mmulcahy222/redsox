<?php 
/**
 * 
 */
 class Site
 {
 	var $site_regex = 'http[\w|\/|:|\\\|\.|\-|\?|=]*';
 	function get_first_match($pattern, $subject)
	{
		preg_match($pattern, $subject, $matches);
		return $matches[0];
	}
	function get_all_matches($pattern, $subject)
	{
		preg_match_all($pattern, $subject, $matches);
		return $matches[0];
	}
 } 
 ?>