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
error_reporting(E_ALL);

$cfg_json = implode('', file('./config.json'));
$cfg = json_decode($cfg_json, true);

$cfg['Debug'] = (in_array(strtolower($cfg['Debug']), array(1, "1", "enable", "enabled", "on", "true", "yes"))) ? true : false;




$cntr[] = array(0);
function PrintDeviceMenu($menu, $depth=0) {
	$i = 0;
	foreach ($menu as $title => $node) {
		$cntr[$depth] = ++$i;
		$num = '';
		for ($j=0; $j<=$depth; $j++) {
			$num .= '_'.$cntr[$j];
		}
		
		if ($node['SubMenu']) {
			echo "<div id='SubMenu$num' class='SubMenu'>\n";
			echo "<div class='SubMenuTitle'>$title</div>\n";
			echo "<div class='SubMenuContent hide'>\n";
			PrintDeviceMenu($node, $depth+1);
			echo "</div>\n";
			echo "</div>\n";
		}
		elseif ($node['Device']) {
			echo "<div id='Device$num' class='Device'>\n";
			echo "<div class='DeviceTitle'>$title</div>\n";
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
<title>HAUS</title>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.5.1/build/cssreset/cssreset-min.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.5.1/build/cssbase/cssbase-min.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.5.1/build/cssfonts/cssfonts-min.css" />
<link rel="stylesheet" type="text/css" href="base.css" />
<script src="http://yui.yahooapis.com/3.5.1/build/yui/yui-min.js"></script>
<script src="base.js" charset="utf-8"></script>
</head>
<body class="yui3-skin-sam yui-skin-sam">


<div id="ControlPanel">
	<p id="title">HAUS</p>
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

<div id="Devices" class="show">
<?php

PrintDeviceMenu($cfg['DeviceMenu'], 0);

?>
</div>


<div id="Help" class="hide">
	<b>Author:</b> Mark Hensler<br />
	<b>GitHub:</b> <a href="https://github.com/mhensler/HAUS" target="_blank">github.com/mhensler/HAUS</a><br />
	<br />
	<a href="http://www.famfamfam.com/lab/icons/silk/" target="_blank">Silk icon set</a> by <a href="mailto:mjames@gmail.com">Mark James</a><br />
</div>

</body>
</html>

