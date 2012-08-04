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


if (strlen($_GET['device'])) {
	# get the requested device id
	$device = $_GET['device'];
	
	# get the device config
	$devdef = $cfg["Devices"][$device];
	$devtype = $cfg["Devices"][$device]['DeviceType'];
	
	# add the namespace
	$devclass = 'HAUS\\'.$devtype;
	
	$log->debug('device='.$device);
	$log->debug('devtype='.$devtype);
	$log->debug('devclass='.$devclass);
	
	include("lib/Device-$devtype.php");
	
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
	
	echo "done.".PHP_EOL;
}




?>