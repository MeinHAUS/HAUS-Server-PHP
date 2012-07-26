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

// First thing we do is detect log4php
if (include('log4php/Logger.php')) {
	Logger::configure('log4php.xml');
	// get the 'main' logger
	$log = Logger::getLogger('main');
}
else {
	// We need to make an empty logger
}

// Read the HAUS config file
$log->debug('Reading config.json');
$cfg_json = implode('', file('./config.json'));
$cfg = json_decode($cfg_json, true);

// Make 'Debug' usable
$cfg['Debug'] = (in_array(strtolower($cfg['Debug']), array(1, "1", "enable", "enabled", "on", "true", "y", "yes"))) ? TRUE : FALSE;

// log the config
$log->debug('$cfg='.$cfg);



?>