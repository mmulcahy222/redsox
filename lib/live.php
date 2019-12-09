<?php 

require_once('simplehtmldom/simple_html_dom.php');
require_once('site.php');

class Live extends Site
{
	var $html = '';

	function __construct()
	{
		$this->download_html();
	}

	function download_html()
	{
		$this->html = str_get_html(file_get_contents("http://live-sports-stream.net/schedule/"));
		$this->html = strtolower($this->html);
	}

	function get_links_by_team($team)
	{
		$site_regex = $this->site_regex;
		$html = $this->html;
		//get the link by the team name
		$urls = $this->get_all_matches("/$team.*?$site_regex/",$html);
		foreach ($urls as $key => $url) {
			$urls[$key] = $this->get_first_match("/$site_regex/",$url);
		}
		return $urls;
	}

	

	// function get_link_by_team($team)
	// {
	// 	$site_regex = $this->site_regex;
	// 	$html = $this->html;
	// 	//get the link by the team name
	// 	$site = $this->get_first_match("/$team.*$site_regex/",$html);
	// 	$site = $this->get_first_match("/$site_regex/",$site);
	// 	return $site;
	// }
}


?>