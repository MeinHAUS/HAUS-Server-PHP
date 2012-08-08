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




function PrintDeviceMenu($menu, $depth=0) {
	global $cfg;
	$indent = "\t\t".str_repeat("\t", $depth);
	
	foreach ($menu as $title => $val) {
		if (is_array($val)) {
			echo "$indent<li>$title".PHP_EOL;
			echo "$indent<ul data-inset='true' data-add-back-btn='true'>".PHP_EOL;
			PrintDeviceMenu($val, $depth+1);
			echo "</ul></li>".PHP_EOL;
		}
		elseif (is_string($val)) {
			echo "$indent<li><a href='device.php?device=$val'>$title</a></li>".PHP_EOL;
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
<meta name="viewport" content="width=device-width, initial-scale=1" /> 
<title><?php echo $cfg["Name"]; ?></title>
<link rel="icon" type="image/png" href="images/house.png" />

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
<link rel="stylesheet" href="base.css" />
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="base.js"></script>
<script src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>

</head>
<body>


<div data-role="page" id="home" data-title="<?php echo $cfg["Name"]; ?>" data-add-back-btn="false">

<div data-role="header">
	<h1><?php echo $cfg["Name"]; ?></h1>
</div>

<div data-role="content">	

	<ul data-role="listview" data-inset="true">
		<li data-role="list-divider">Device Menu</li>
<?php
		PrintDeviceMenu($cfg['Menu'], 0);
?>
	</ul>
	<ul data-role="listview" data-inset="true">
		<li data-role="list-divider">System</li>
<?php if ($cfg["Debug"]) { ?>
		<li><a href="#debug" data-transition="slide">Debug</a></li>
<?php } ?>
		<li data-icon="gear">Settings</li>
		<li data-icon="info"><a href="#about" data-transition="slide">About</a></li>
	</ul>

</div><!-- /content -->
</div><!-- /page -->



<div data-role="page" id="debug" data-title="Debug" data-add-back-btn="true">

<div data-role="header">
	<h1 >Debug</h1>
</div><!-- /header -->

<div data-role="content">

<?php if ($cfg["Debug"]) { ?>
	<textarea id="dbgConfig">$cfg = <?php print_r($cfg); ?></textarea>
<?php } ?>
</div><!-- /content -->
</div><!-- /page -->




<?php if ($cfg["Debug"]) { ?>
	<div id="Debug" class="hide">
		<textarea id="dbgConfig">$cfg = <?php print_r($cfg); ?></textarea>
	</div>
<?php } ?>

<div data-role="page" id="about" data-title="About" data-add-back-btn="true">

<div data-role="header">
	<h1 >About</h1>
</div><!-- /header -->

<div data-role="content">

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

</div><!-- /content -->
</div><!-- /page -->


</body>
</html>

