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
error_reporting(E_ALL | E_STRICT);

// First thing we do is detect log4php
if (include('log4php/Logger.php')) {
	Logger::configure('log4php.xml');
	// get the 'main' logger
	$log = Logger::getLogger('main');
	$log->debug('Initializing');
}
else {
	// We need to make a fake logger
	// so that our $log calls don't cause errors
	class fakeLogger {
		function fatal($string) {}
		function error($string) {}
		function warn($string) {}
		function info($string) {}
		function debug($string) {}
		function trace($string) {}
	}
	$log = new fakeLogger();
}

$log->debug('Loading minify.json.php');
include_once('lib/minify.json.php');

if (!function_exists('json_minify')) {
	$log->warn('Error loading json_minify() from lib/minify.json.php.  Comments in your config.json may cause errors.');
}

// Read the HAUS config file
$log->debug('Reading config.json');
$cfg = implode('', file('./config.json'));
if (function_exists('json_minify')) {
	$log->debug('Minifying config.json');
	$cfg = json_minify($cfg);
}
$cfg = json_decode($cfg, true);

// Were there problems deconding the json?
if (is_null($cfg)) {
	$log->error('Error decoding config.json');
}

// Make 'Debug' usable
$cfg['Debug'] = toBool($cfg['Debug']);

// log the config
$log->trace('$cfg='.print_r($cfg, true));




function toBool($string) {
	return (in_array(strtolower($string),
		array(1, "1", "enable", "enabled", "on", "true", "y", "yes"))) ? TRUE : FALSE;
}

?>