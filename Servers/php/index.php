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

$cfg_json = implode('', file('./config.json'));
$cfg = json_decode($cfg_json, true);

$cfg{'Debug'} = (in_array(strtolower($cfg{'Debug'}), array(1, "1", "enable", "enabled", "on", "true", "yes"))) ? true : false;

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
	<div class="ControlButton hide" id="ToggleSettings"></div>
	<div class="ControlButton" id="ToggleHelp"></div>
</div>


<div id="Settings" class="hide">
	<div>
	Settings go here.
	</div>
</div>


<div id="Help" class="hide">
	<b>Author:</b> Mark Hensler<br />
	<b>GitHub:</b> <a href="https://github.com/mhensler/HAUS" target="_blank">github.com/mhensler/HAUS</a><br />
	<br />
	<a href="http://www.famfamfam.com/lab/icons/silk/" target="_blank">Silk icon set</a> by <a href="mailto:mjames@gmail.com">Mark James</a><br />
</div>

</body>
</html>

