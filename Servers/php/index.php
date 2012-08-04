<?php
/*******************************************************************************
 * 
 * Copyright 2012 Mark Hensler
 * 
 * This file is part of HAUS.
 *
 * Haus is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Peneral Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * HAUS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with HAUS.  If not, see <http://www.gnu.org/licenses/>.
 *
 ******************************************************************************/
require_once('./init.php');




$cntr = array(0);
function PrintDeviceMenu($menu, $depth=0) {
	global $cfg, $cntr;
	$i = 0;
	
	foreach ($menu as $title => $val) {
		$cntr[$depth] = ++$i;
		$num = '';
		for ($j = 0; $j<=$depth; $j++) {
			$num .= '_'.$cntr[$j];
		}
		
		if (is_array($val)) {
			echo "<div class='Menu' id='Menu$num'>".PHP_EOL;
			echo "<div class='MenuTitle'>$title</div>".PHP_EOL;
			echo "<div class='SubMenu hide'>".PHP_EOL;
			
			// traverse the SubMenu
			PrintDeviceMenu($val, $depth+1);
			
			// then blank out the depth counter
			$cntr[$depth+1] = 0;
			
			echo "</div>".PHP_EOL;
			echo "</div>".PHP_EOL;
		}
		elseif (is_string($val)) {
			
			$Device = $cfg['Devices']["$val"];
			$DeviceType = 'DeviceType_'.$Device['DeviceType'];
			
			echo "<div class='Device $DeviceType' id='Device_$val'>".PHP_EOL;
			echo "<div class='DeviceTitle'>$title</div>".PHP_EOL;
			echo "<div class='DeviceConfig hide'>".PHP_EOL;
			echo "<pre>".print_r($Device, true)."</pre>".PHP_EOL;
			echo "</div>".PHP_EOL;
			echo "</div>".PHP_EOL;
		}
		else {
			# not sure what we're looking at
			# skip it
			continue;
		}
	}
}




/******************************************************************************/
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
<title><?php echo $cfg["Name"]; ?></title>
<link rel="icon" type="image/png" href="images/house.png" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.5.1/build/cssreset/cssreset-min.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.5.1/build/cssbase/cssbase-min.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.5.1/build/cssfonts/cssfonts-min.css" />
<link rel="stylesheet" type="text/css" href="base.css" />
<script src="http://yui.yahooapis.com/3.5.1/build/yui/yui-min.js"></script>
<script src="base.js" charset="utf-8"></script>
</head>
<body class="yui3-skin-sam yui-skin-sam">


<div id="ControlPanel">
	<p id="title"><?php echo $cfg["Name"]; ?></p>
	<!-- ToggleConsole -->
	<?php if ($cfg["Debug"]) { echo '<div class="ControlButton" id="ToggleDebug" title="Debug"></div>'; } ?>
	<div class="ControlButton hide" id="ToggleSettings" title="Settings"></div>
	<div class="ControlButton" id="ToggleHelp" title="About"></div>
</div>

<?php if ($cfg["Debug"]) { ?>
<div id="Debug" class="hide">
	<textarea id="dbgConfig">$cfg = <?php print_r($cfg); ?></textarea>
</div>
<?php } ?>

<div id="Settings" class="hide">
	<div>
	Settings go here.
	</div>
</div>

<div id="DeviceMenu" class="show">
<?php

PrintDeviceMenu($cfg['Menu'], 0);

?>
</div>


<div id="Help" class="hide">
	<b><?php echo $cfg["Name"]; ?></b><br />
<?php
	if (is_array($cfg["Location"]) && !empty($cfg["Location"])) {
		echo "\t<address>";
		foreach ($cfg["Location"] as $line) {
			echo "\t$line<br />".PHP_EOL;
		}
		echo "\t</address>".PHP_EOL;
	}
?>
	<br />
	<b>GitHub:</b> <a href="https://github.com/mhensler/HAUS" target="_blank">github.com/mhensler/HAUS</a><br />
	<b>Icons:</b> <a href="http://www.famfamfam.com/lab/icons/silk/" target="_blank">Silk Icon Set</a> by <a href="mailto:mjames@gmail.com">Mark James</a><br />
</div>

</body>
</html>

