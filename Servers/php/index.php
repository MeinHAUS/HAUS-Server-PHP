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




$path = array();
function PrintDeviceMenu($menu, $depth=0) {
	global $path;
	
	foreach ($menu as $node) {
		if (isset($node['Menu'])) {
			array_push($path, $node['MenuID']);
			$MenuId = 'Menu_'.implode('_', $path);
			array_pop($path);
			
			echo "<div class='Menu' id='$MenuId'>\n";
			echo "<div class='MenuTitle'>$node[MenuName]</div>\n";
			echo "<div class='SubMenu hide'>\n";
			
			// traverse the SubMenu
			array_push($path, $node['MenuID']);
			PrintDeviceMenu($node['Menu'], $depth+1);
			array_pop($path);
			
			// then blank out the depth counter
			$cntr[$depth+1] = 0;
			
			echo "</div>\n";
			echo "</div>\n";
		}
		elseif (isset($node['DeviceType'])) {
			array_push($path, $node['DeviceID']);
			$DeviceId = 'Device_'.implode('_', $path);
			array_pop($path);
			
			$DeviceType = "DeviceType_$node[DeviceType]";
			
			echo "<div class='Device $DeviceType' id='$DeviceId'>\n";
			echo "<div class='DeviceTitle'>$node[DeviceName]</div>\n";
			echo "<div class='DeviceConfig hide'>\n";
			echo "<pre>".print_r($node, true)."</pre>\n";
			echo "</div>\n";
			echo "</div>\n";
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
<meta charset="ISO-8859-1" />
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

PrintDeviceMenu($cfg['DeviceMenu'], 0);

?>
</div>


<div id="Help" class="hide">
	<b><?php echo $cfg["Name"]; ?></b><br />
<?php
	if (is_array($cfg["Location"]) && !empty($cfg["Location"])) {
		echo "\t<address>";
		foreach ($cfg["Location"] as $line) {
			echo "\t$line<br />\n";
		}
		echo "\t</address>\n";
	}
?>
	<br />
	<b>GitHub:</b> <a href="https://github.com/mhensler/HAUS" target="_blank">github.com/mhensler/HAUS</a><br />
	<b>Icons:</b> <a href="http://www.famfamfam.com/lab/icons/silk/" target="_blank">Silk Icon Set</a> by <a href="mailto:mjames@gmail.com">Mark James</a><br />
</div>

</body>
</html>

