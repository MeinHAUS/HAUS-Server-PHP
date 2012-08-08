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
require_once('lib/jqmPhp/jqmPhp.php');


if (strlen($_GET['device'])) {
	# get the requested device id
	$device = $_GET['device'];
	
	# get the device definition from config.json
	$devdef = $cfg["Devices"][$device];
	
	# set the DeviceID
	$devdef['DeviceID'] = $device;
	
	# get the DeviceType
	$devtype = $devdef['DeviceType'];
	
	# add the namespace
	$devclass = 'HAUS\\'.$devtype;
	
	$log->debug('device='.$device);
	$log->debug('devtype='.$devtype);
	$log->debug('devclass='.$devclass);
	
	require_once("lib/Device-$devtype.php");
	
	if (!class_exists($devclass)) {
		$log->fatal("Error loading device files for [$devclass].");
		exit;
	}
	
	# attempt to instanciate the device
	eval('$Device = new '.$devclass.'($devdef);');

	if (!$Device) {
		$log->fatal("Error instanciating device [$devclass].");
		exit;
	}
}


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" /> 
<title><?php echo $cfg["Name"]; ?>: <?php echo $Device->DeviceName; ?></title>
<link rel="icon" type="image/png" href="images/house.png" />

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
<link rel="stylesheet" href="base.css" />
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="base.js"></script>
<script src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>

</head>
<body>


<div data-role="page" data-title="<?php echo $Device->DeviceName; ?>">

<div data-role="header">
	<a href="index.php" data-icon="home" class="ui-btn-left">Home</a>
	<h1><?php echo $Device->DeviceName; ?></h1>
</div>

<div data-role="content">
	<?php echo $Device->getControls(); ?>
<?php if ($cfg["Debug"]) { ?>
	<h2>Config:</h2>
	<textarea><?php print_r($Device->cfg); ?></textarea>
<?php } ?>
</div><!-- /content -->
</div><!-- /page -->



</body>
</html>

