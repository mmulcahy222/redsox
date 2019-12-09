<?php

require_once('lib/wiz.php');
require_once('lib/live.php');

$mlb_teams = array('angels', 'astros', 'athletics', 'blue jays', 'braves', 'brewers', 'cardinals', 'cubs', 'dodgers', 'giants', 'indians', 'mariners', 'marlins', 'mets', 'nationals', 'orioles', 'padres', 'phillies', 'pirates', 'rangers', 'rays', 'red sox', 'reds', 'rockies', 'royals', 'tigers', 'twins',  'white sox', 'yankees');
$nba_teams = array('76ers', 'blazers', 'bucks', 'bulls', 'cavaliers', 'celtics', 'clippers', 'grizzlies', 'heat', 'hornets', 'jazz', 'kings', 'knicks', 'lakers', 'magic', 'mavericks', 'nets', 'nuggets', 'pacers', 'pelicans', 'pistons', 'raptors', 'rockets', 'spurs', 'suns', 'thunder', 'timberwolves', 'warriors', 'wizards');
$nfl_teams = array('49ers', 'bears', 'bengals', 'bills', 'broncos', 'browns', 'buccaneers', 'chargers', 'chiefs', 'colts', 'cowboys', 'dolphins', 'eagles', 'falcons', 'giants', 'jaguars', 'jets', 'lions', 'packers', 'panthers', 'patriots', 'raiders', 'rams', 'ravens', 'redskins', 'saints', 'seahawks', 'steelers', 'texans', 'titans', 'vikings');
$nhl_teams = array('avalanche', 'blackhawks', 'blues', 'bruins', 'canadiens', 'canucks', 'capitals', 'coyotes', 'devils', 'flames', 'flyers', 'golden knights', 'hurricanes', 'islanders', 'jackets', 'jets', 'kings', 'leafs', 'lightning', 'oilers', 'panthers', 'penguins', 'predators', 'rangers', 'red wings' ,'sabres', 'senators', 'sharks', 'stars', 'wild');
$wwe_teams = array('wwe');

$wiz = new Wiz(); 
$live = new Live();
$sources = array($wiz,$live);
$league_order = array($mlb_teams,$nba_teams,$nfl_teams,$nhl_teams,$wwe_teams);
$nodes = array();
$default_team = 'red sox';
$default_links = array();
$count = 0;
//FILL NODES ARRAY WITH THE LINKS
foreach ($league_order as $league_array) {
	foreach ($league_array as $key => $team_name) {
		foreach ($sources as $key => $source) {
			$links = $source->get_links_by_team($team_name);
			foreach ($links as $key => $link) {
				if(!empty($link))
				{
					//fill nodes
					$nodes[$count][$team_name][] = $link;
					//fill default link
					if($team_name == $default_team)
					{
						$default_links[] = $link;
					}
				}
			}
		}
	}
	$count++;
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="">
	<title>Red Sox</title>

	<!-- styles -->
	<link rel="stylesheet" type="text/css" href="css/style.css?v=<?php echo time(); ?>">

	<!-- scripts -->
	<script src="js/jquery-3.1.1.min.js"></script>
	
</head>
<body>
<div class="header">
	<?php 
	foreach ($nodes as $key => $team_names) {
		echo '<div class="header_item">';
		echo '<div class="custom-select">';
		echo '<select>';
		$value_count = 0;
		foreach ($team_names as $team_name => $links) {
			foreach ($links as $link_value => $link) {
				$link_value = $link_value + 1;
				echo '<option value="'.$value_count.'" link="'.$link.'">'.strtoupper($team_name) . (intval($link_value)>1 ? " $link_value" : '') . '</option>';
			}
		}
		echo '</select>';
		echo '</div>';
		echo '</div>';
	}
	?>
</div>
<div class="container">
	<script>open('<?php echo ($default_links[0]);?>')</script>
	<iframe class="external_site" src="<?php echo (isset($default_links[0]) ? $default_links[0] : ''); ?>" frameborder="1">
		
	</iframe> 
</div>
<script src="js/custom.js?t=<?php echo time(); ?>"></script>

</body>
</html>